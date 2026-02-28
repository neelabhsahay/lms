#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for ASIC, Device, and Port tables
"""

from fastapi import FastAPI, HTTPException, Depends
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime
from auth.auth_handler import security, decodeJWT

from sqlalchemy import Column, String, DateTime, Integer
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session

from config.Db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse

# ASIC Models
class ASICDb(Base):
    __tablename__ = "asic"

    id = Column(Integer(), autoincrement=True, primary_key=True)
    asic_type = Column(String(45))
    updated_by = Column(String(100))
    updated_on = Column(DateTime, onupdate=datetime.now)

class ASICBase(BaseModel):
    asic_type: str
    updated_by: Optional[str] = None

class ASICCreate(ASICBase):
    update_on: datetime = Field(default_factory=datetime.now)
    pass

class ASICUpdate(BaseModel):
    asic_type: Optional[str] = None
    updated_by: Optional[str] = None
    update_on: datetime = Field(default_factory=datetime.now)

class ASIC(ASICBase):
    id: int
    updated_on: Optional[datetime] = None

    class ConfigDict:
        from_attributes = True

class ASICOut(BaseModel):
    body: List[ASIC] = []
    itemCount: int
    totalCount: int

# Data base
def getASICDb(db: Session, asic_id: int):
    return db.query(ASICDb).filter(ASICDb.id == asic_id).first()

def getASIC(db: Session, asic_id: int):
    asic = getASICDb(db, asic_id=asic_id)
    if asic is None:
        return None
    else:
        return makeJSONGetResponse(asic, 1)

def getASICs(db: Session, getCount: bool = False,
             skip: int = 0, limit: int = 100):
    asics = db.query(ASICDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(ASICDb).count()
    else:
        count = 0
    return makeJSONGetResponse(asics, count)

def insertASIC(db: Session, asic: ASICCreate):
    asicDetail = asic.dict(exclude_unset=True)
    asicDb = ASICDb(**asicDetail)
    try:
        db.add(asicDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to create new asic",
                                      "reason", error)
    else:
        db.refresh(asicDb)
        return makeJSONInsertResponse("passed", "New asic is created.",
                                      "id", asicDb.id)

def updateASICs(db: Session, db_asic: ASICDb, updates: ASICUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_asic, var, value) if value else None
    try:
        db.add(db_asic)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update asic",
                                      "reason", error)
    else:
        db.refresh(db_asic)
        return makeJSONInsertResponse("passed",
                                      "ASIC record is updated.",
                                      "asic id", db_asic.id)

def deleteASIC(db: Session, db_asic: ASICDb):
    try:
        db.delete(db_asic)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to delete new asic",
                                      "reason", error)

