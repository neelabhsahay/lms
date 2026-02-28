#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for Device, Device, and Port tables
"""

from fastapi import FastAPI, HTTPException, Depends
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime
from auth.auth_handler import security, decodeJWT

from sqlalchemy import Column, String, DateTime, Integer, ForeignKey
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session

from config.Db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse

class DeviceDb(Base):
    __tablename__ = "device"

    id = Column(Integer(), primary_key=True)
    name = Column(String(100), nullable=False)
    mgmt_ip = Column(String(100))
    console_ip = Column(String(100))
    console_port = Column(Integer())
    asic = Column(Integer(), ForeignKey("asic.id"))
    present_on = Column(Integer(), ForeignKey("host.id"))
    updated_by = Column(String(100))
    updated_on = Column(DateTime, onupdate=datetime.now)

# Device Models
class DeviceBase(BaseModel):
    name: str
    type: str = Field(..., pattern="^(nic|switch)$")
    asic: Optional[int] = None # foreign key to ASIC
    mgmt_ip: Optional[str] = None
    console_ip: Optional[str] = None
    console_port: Optional[int] = None
    present_on: Optional[int] = None # foreign key to host
    updated_by: Optional[str] = None

class DeviceCreate(DeviceBase):
    pass

class DeviceUpdate(BaseModel):
    name: Optional[str] = None
    type: Optional[str] = Field(None, pattern="^(nic|switch)$")
    asic: Optional[int] = None # foreign key to ASIC
    mgmt_ip: Optional[str] = None
    console_ip: Optional[str] = None
    console_port: Optional[int] = None
    present_on: Optional[int] = None # foreign key to host
    updated_by: Optional[str] = None

class Device(DeviceBase):
    id: int
    asic_str: Optional[str] = None
    updated_on: datetime

    class ConfigDict:
        from_attributes = True

def DeviceOut(BaseModel):
    body: List[Device] = []
    itemCount: int
    totalCount: int

class DeviceIPUpdate(BaseModel):
    mgmt_ip: Optional[str] = None
    console_ip: Optional[str] = None
    console_port: Optional[int] = None
    updated_by: Optional[str] = None

class DeviceIpInfo(BaseModel):
    id: int
    name: str
    asic_str: Optional[str] = None
    mgmt_ip: Optional[str] = None
    console_ip: Optional[str] = None
    console_port: Optional[int] = None

class DeviceIpInfoOut(BaseModel):
    body: List[DeviceIpInfo]
    itemCount: int
    totalCount: int

# Data base
def getDeviceDb(db: Session, device_id: int):
    return db.query(DeviceDb).filter(DeviceDb.id == device_id).first()

def getDevice(db: Session, device_id: int):
    device = getDeviceDb(db, device_id=device_id)
    if device is None:
        return None
    else:
        return makeJSONGetResponse(device, 1)

def getDevices(db: Session, getCount: bool = False,
             skip: int = 0, limit: int = 100):
    devices = db.query(DeviceDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(DeviceDb).count()
    else:
        count = 0
    return makeJSONGetResponse(devices, count)

def insertDevice(db: Session, device: DeviceCreate):
    deviceDetail = device.dict(exclude_unset=True)
    deviceDb = DeviceDb(**deviceDetail)
    try:
        db.add(userDb)
        db.commit()
    except SQCALchemyErrror as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to create new device",
                                      "reason", error)
    else:
        db.refresh(userDb)
        return makeJSONInsertResponse("passed", "New device is created.",
                                      "id", device.id)

def updateDevice(db: Session, db_device: DeviceDb, updates: DeviceUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_device, var, value) if value else None
    try:
        db.add(db_device)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update device",
                                      "reason", error)
    else:
        db.refresh(db_device)
        return makeJSONInsertResponse("passed",
                                      "Device record is updated.",
                                      "device id", db_device.id)

def deleteDevice(db: Session, db_device: DeviceDb):
    try:
        db.delete(db_device)
        db.commit()
    except SQCALchemyErrror as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to delete new device",
                                      "reason", error)
    else:
        db.refresh(db_device)
        return makeJSONInsertResponse("passed",
                                      "Device record is deleted.",
                                      "device id", db_device.id)

def updateDeviceIpInfo(db: Session, db_device: DeviceDb, updates: DeviceIPUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_device, var, value) if value else None
    try:
        db.add(db_device)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update device",
                                      "reason", error)
    else:
        db.refresh(db_device)
        return makeJSONInsertResponse("passed",
                                      "Device record is updated.",
                                      "device id", db_device.id)

def getDeviceIpInfo(db: Session, db_device: DeviceDb):
    deviceIp = DeviceIpInfo()
    for var, value in vars(db_device).items():
        if hasattr(deviceIp, var):
            setattr(deviceIp, var, value) if value else None
    return makeJSONGetResponse(deviceIp, 1)
