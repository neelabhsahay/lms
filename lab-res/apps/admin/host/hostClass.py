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
import enum
from sqlalchemy import Boolean, Column, ForeignKey, BigInteger, String, Enum, \
	 DateTime, Integer
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session, joinedload

from contextlib import contextmanager
from auth.auth_handler import security, decodeJWT

from config.Db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse, \
	 makeJSONGetEmptyResponse

# Adding Device Details
from admin.device.deviceClass import DeviceDb, DeviceDetailCreate, DeviceDetailOut

# Adding Port Details
from admin.port.portClass import PortDb, PortCreate, PortOut

# Inheriting from 'str' allows Pydantic to validate string inputs easily
class HostStatusEnum(str, enum.Enum):
    up = "up"
    down = "down"
    removed = "removed"

class HostDb(Base):
    __tablename__ = "host"

    id = Column(Integer, autoincrement=True, primary_key=True)
    name = Column(String(255), nullable=False)
    # Tell SQLAlchemy to use your Python Enum class
    status = Column(Enum(HostStatusEnum), default=HostStatusEnum.up)
    mgmt_ip = Column(String(45))
    bmc_ip = Column(String(45))
    has_gpu = Column(Boolean, default=True, nullable=False)
    is_locked = Column(Boolean, default=True, nullable=False)
    updated_by = Column(String(100))
    updated_on = Column(DateTime, onupdate=datetime.now)
    present_used_by = Column(String(100))
    reserved_at = Column(DateTime, onupdate=datetime.now)

    # Relationship to Device table
    devices = relationship("DeviceDb", back_populates="host")


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

class HostDetailCreate(HostCreate):
    devices: List[DeviceDetailCreate] = []

class HostDetailOut(Host):
    devices: List[DeviceDetailOut] = []

class HostFilter(BaseModel):
    status: Optional[HostStatusEnum] = None
    reserved: Optional[bool] = None
    name: Optional[str] = None

# Data base
def getHostDb(db: Session, host_id: int):
    return db.query(HostDb).filter(HostDb.id == host_id).first()

def getHost(db: Session, host_id: int):
    host = getHostDb(db, host_id=host_id)
    if host is None:
        return makeJSONGetEmptyResponse()
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

def getDetailHost(db: Session, host_id: int):
    return db.query(HostDb).options(joinedload(HostDb.devices).joinedload(
    		    DeviceDb.ports)).filter(HostDb.id == host_id).first()

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

def insertDetailHost(db: Session, detail_host: HostDetailCreate):
    # 1. Convert Pydantic object to dict (if using FastAPI/Pydantic)
    # or use vars(detail_host) if it's a simple class
    data = detail_host.model_dump() if hasattr(detail_host, 'model_dump') else detail_host.__dict__

    # 2. Extract nested data
    devices_data = data.pop('devices', [])


    # 2. Filter Host columns and create the Host instance
    host_cols = HostDb.__table__.columns.keys()
    host_data = {k: v for k, v in data.items() if k in host_cols}
    new_host = HostDb(**host_data)

    # 3. Process each device
    for dev_dict in devices_data:
        # Pop nested 'ports' data from the device dictionary
        ports_data = dev_dict.pop('ports', [])

        # Filter Device columns and create the Device instance
        dev_cols = DeviceDb.__table__.columns.keys()
        dev_data = {k: v for k, v in dev_dict.items() if k in dev_cols}
        new_device = DeviceDb(**dev_data)

        # 4. Process each port and attach to the device
        for port_dict in ports_data:
            # Assuming PortDb columns are filtered or match exactly
            new_port = PortDb(**port_dict)
            new_device.ports.append(new_port)

        # 5. Attach the device (which now contains ports) to the host
        new_host.devices.append(new_device)

    try:
    	db.add(new_host)
    	db.commit()
    except SQCALchemyErrror as e:
    	db.rollback()
    	error = str(e.__dict__['orig'])
    	return makeJSONInsertResponse("failed", "Unable to create new host",
    		                      "reason", error)
    else:
    	db.refresh(new_host)
    	return makeJSONInsertResponse("passed", "New host is created.",
    		                      "id", new_host.id)

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

def getFilteredHosts(db: Session, filters: dict):
    query = db.query(HostDb).options(joinedload(HostDb.devices).joinedload(
    		    DeviceDb.ports))
    
    # Convert Pydantic model to dict, ignoring None values
    filter_data = filters.model_dump(exclude_none=True)

    # Apply 'status' filter
    if "status" in filter_data:
        query = query.filter(HostDb.status == filter_data["status"])

    # Apply 'reserved' logic
    if "reserved" in filter_data:
        if filter_data["reserved"] is True:
            query = query.filter(HostDb.present_used_by.isnot(None))
        else:
            query = query.filter(HostDb.present_used_by.is_(None))
            
    # Apply 'name' filter (partial match example)
    if "name" in filter_data:
        query = query.filter(HostDb.name.contains(filter_data["name"]))

    host = query.all()
    if host is None:
        return makeJSONGetEmptyResponse()
    else:
        return makeJSONGetResponse(host, 1)

