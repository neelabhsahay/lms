#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for Port, Device, and Port tables
"""

from fastapi import FastAPI, HTTPException, Depends
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime
from auth.auth_handler import security, decodeJWT

from sqlalchemy import Column, Enum, String, DateTime, Integer, ForeignKey
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session

from config.Db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse, \
	 makeJSONGetEmptyResponse

class PortDb(Base):
    __tablename__ = "port"

    id = Column(Integer, primary_key=True)
    name = Column(String(45))
    port_status = Column(Enum('up', 'down', 'removed'), default='up')
    connected = Column(Integer, ForeignKey("port.id")) # key to other entry
    present_on = Column(Integer, ForeignKey("device.id")) # foreign key to device
    updated_by = Column(String(100))
    updated_on = Column(DateTime, onupdate=datetime.now)


    # Relation ship to Device table
    device = relationship("DeviceDb", back_populates="ports")

# Port Models
class PortBase(BaseModel):
    name: str
    port_status: str = Field(..., pattern="^(up|down|removed)$")
    connected: Optional[int] = None
    present_on: Optional[int] = None
    updated_by: Optional[str] = None

class PortCreate(PortBase):
    updated_on: datetime = Field(default_factory=datetime.now)
    pass

class PortUpdate(BaseModel):
    name: Optional[str] = None
    connected: Optional[int] = None
    present_on: Optional[int] = None
    port_status: Optional[str] = Field(None, pattern="^(up|down|removed)$")
    updated_by: Optional[str] = None
    updated_on: datetime = Field(default_factory=datetime.now)

class Port(PortBase):
    id: int
    updated_on: Optional[datetime] = None

    class ConfigDict:
        from_attributes = True

class PortOut(BaseModel):
    body: List[Port] = []
    itemCount: int
    totalCount: int

# Data base
def getPortDb(db: Session, port_id: int):
    return db.query(PortDb).filter(PortDb.id == port_id).first()

def getPort(db: Session, port_id: int):
    port = getPortDb(db, port_id=port_id)
    if port is None:
        return makeJSONGetEmptyResponse()
    else:
        return makeJSONGetResponse(port, 1)

def getPorts(db: Session, getCount: bool = False,
             skip: int = 0, limit: int = 100):
    ports = db.query(PortDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(PortDb).count()
    else:
        count = 0
    return makeJSONGetResponse(ports, count)

def insertPort(db: Session, port: PortCreate):
    portDetail = port.dict(exclude_unset=True)
    portDb = PortDb(**portDetail)
    try:
        db.add(portDb)
        db.commit()
    except SQLAlchemyErrror as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to create new port",
                                      "reason", error)
    else:
        db.refresh(portDb)
        return makeJSONInsertResponse("passed", "New port is created.",
                                      "id", portDb.id)

def updatePort(db: Session, db_port: PortDb, updates: PortUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_port, var, value) if value else None
    try:
        db.add(db_port)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update port",
                                      "reason", error)
    else:
        db.refresh(db_port)
        return makeJSONInsertResponse("passed",
                                      "Port record is updated.",
                                      "port id", db_port.id)

def deletePort(db: Session, db_port: PortDb):
    try:
        db.delete(db_port)
        db.commit()
    except SQLAlchemyErrror as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to delete new port",
                                      "reason", error)

