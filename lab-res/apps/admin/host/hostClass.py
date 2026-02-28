#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for Host, Device, and Port tables
"""

from fastapi import FastAPI, HTTPException, Depends
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime

from sqlalchemy import Boolean, Column, ForeignKey, BigInteger, String, Enum, \
	 DateTime, Integer
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session

from contextlib import contextmanager
from auth.auth_handler import security, decodeJWT

from config.Db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse

class HostDb(Base):
    __tablename__ = "host"

    id = Column(Integer, autoincrement=True, primary_key=True)
    name = Column(String(255), nullable=False)
    status = Column(Enum('up', 'down', 'removed'), default='up')
    mgmt_ip = Column(String(45))
    bmc_ip = Column(String(45))
    updated_by = Column(String(100))
    updated_on = Column(DateTime, onupdate=datetime.now)
    present_used_by = Column(String(100))
    reserved_at = Column(DateTime, onupdate=datetime.now)


# Pydantic Models for Request/Response

# Host Models
class HostBase(BaseModel):
    name: str
    status: str = Field(..., pattern="^(up|down|removed)$")
    mgmt_ip: Optional[str] = None
    bmc_ip: Optional[str] = None
    updated_by: Optional[str] = None
    present_used_by: Optional[str] = None
    reserved_at: Optional[datetime] = None

class HostCreate(HostBase):
    update_on: datetime = Field(default_factory=datetime.now)
    pass

class HostUpdate(BaseModel):
    name: Optional[str] = None
    status: Optional[str] = Field(None, pattern="^(up|down|removed)$")
    mgmt_ip: Optional[str] = None
    bmc_ip: Optional[str] = None
    updated_by: Optional[str] = None
    present_used_by: Optional[str] = None
    reserved_at: Optional[datetime] = None
    update_on: datetime = Field(default_factory=datetime.now)

class Host(HostBase):
    id: int
    updated_on: Optional[datetime] = None

    class ConfigDict:
        from_attributes = True

class HostOut(BaseModel):
    body: List[Host] = []
    itemCount: int
    totalCount: int

class HostIPUpdate(BaseModel):
    mgmt_ip: Optional[str] = None
    bmc_ip: Optional[str] = None

# Data base
def getHostDb(db: Session, host_id: int):
    return db.query(HostDb).filter(HostDb.id == host_id).first()

def getHost(db: Session, host_id: int):
    host = getHostDb(db, host_id=host_id)
    if host is None:
        return None
    else:
        return makeJSONGetResponse(host, 1)

def getHosts(db: Session, getCount: bool = False,
	     skip: int = 0, limit: int = 100):
    hosts = db.query(HostDb).offset(skip).limit(limit).all()
    if getCount:
    	count = db.query(HostDb).count()
    else:
    	count = 0
    return makeJSONGetResponse(hosts, count)

def insertHost(db: Session, host: HostCreate):
    hostDetail = host.dict(exclude_unset=True)
    hostDb = HostDb(**hostDetail)
    try:
    	db.add(hostDb)
    	db.commit()
    except SQCALchemyErrror as e:
    	db.rollback()
    	error = str(e.__dict__['orig'])
    	return makeJSONInsertResponse("failed", "Unable to create new host",
    		                      "reason", error)
    else:
    	db.refresh(hostDb)
    	return makeJSONInsertResponse("passed", "New host is created.",
    		                      "id", hostDb.id)

def updateHost(db: Session, db_host: HostDb, updates: HostUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
    	setattr(db_host, var, value) if value else None
    try:
    	db.add(db_host)
    	db.commit()
    except SQLAlchemyError as e:
    	db.rollback()
    	error = str(e.__dict__['orig'])
    	return makeJSONInsertResponse("failed", "Unable to update host",
    		                      "reason", error)
    else:
    	db.refresh(db_host)
    	return makeJSONInsertResponse("passed",
    		                      "Host record is updated.",
    		                      "host id", db_host.id)

def deleteHost(db: Session, db_host: HostDb):
    try:
    	db.delete(db_host)
    	db.commit()
    except SQLAlchemyErrror as e:
    	db.rollback()
    	error = str(e.__dict__['orig'])
    	return makeJSONInsertResponse("failed", "Unable to delete new host",
    		                      "reason", error)
    else:
    	db.refresh(db_host_db)
    	return makeJSONInsertResponse("passed", "Host is deleted.",
    		                      "id", id)

def reserveFreeHost(db: Session, db_host: HostDb, reserved_by: str,
	            updated_by: str, free: bool = False):
    setattr(db_host, "updated_by", updated_by)

    if (free == True):
        setattr(db_host, "present_used_by", None)
    else:
        setattr(db_host, "present_used_by", reserved_by)
    # Add current time
    #db_host.reserved_at
    try:
    	db.add(db_host)
    	db.commit()
    except SQLAlchemyError as e:
    	db.rollback()
    	error = str(e.__dict__['orig'])
    	return makeJSONInsertResponse("failed", "Unable to update host",
    		                      "reason", error)
    else:
    	db.refresh(db_host)
    	return makeJSONInsertResponse("passed",
    		                      "Host record is updated.",
    		                      "id", db_host.id)

def ipInfoHost(db: Session, db_host: HostDb):
    return

def updateIpInfoHost(db: Session, db_host: HostDb, updates: HostIPUpdate,
	             reserved_by: str):
    db_host.updated_by = reserved_by
    for var, value in vars(updates).items():
    	setattr(db_host, var, value) if value else None

    # Add current time
    #db_host.reserved_at
    try:
    	db.add(db_host)
    	db.commit()
    except SQLAlchemyError as e:
    	db.rollback()
    	error = str(e.__dict__['orig'])
    	return makeJSONInsertResponse("failed", "Unable to update host",
    		                      "reason", error)
    else:
    	db.refresh(db_host)
    	return makeJSONInsertResponse("passed",
    		                      "Host record is updated.",
    		                      "id", db_host.id)


