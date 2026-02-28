#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for Host, Device, and Port tables
"""

from fastapi import FastAPI, HTTPException, Depends, APIRouter
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime
from contextlib import contextmanager

from config.Db import get_db
from admin.device.deviceClass import *


# ==================== DEVICE ENDPOINTS ====================

router = APIRouter(
    prefix="/devices",
    tags=["devices"],
    responses={404: {"description": "Not found"}},
)

@router.get("/", response_model=DeviceOut)
@router.get("/{device_id}", response_model=Device)
def get_device(device_id: Optional[int] = None, getCount: bool = False,
	           skip: int = 0, limit: int = 100,
	           db: Session = Depends(get_db),
	           token: str = Depends(decodeJWT)):
    """Get a specific device by ID and all"""
    if (device_id is None):
    	devices = getDevices(db, getCount=getCount,
    		             skip=skip, limit=limit)
    else:
    	devices = getDevice(db, device_id=device_id)
    return devices

@router.post("/")
def create_device(device: DeviceCreate,
	              db: Session = Depends(get_db),
	              token: str = Depends(decodeJWT)):
    """Create a new device"""
    return insertDevice(db, device=device)

@router.put("/{device_id}")
def update_device(device_id: int, device: DeviceUpdate,
	              db: Session = Depends(get_db),
	              token: str = Depends(decodeJWT)):
    """Update an existing device"""
    existing_device = getDeviceDb(db, device_id=device_id)
    if existing_device is None:
    	raise HTTPException(status_code=404, detail="Device not found")
    return updateDevice(db, db_device=existing_device, updates=device)

@router.delete("/{device_id}")
def delete_device(device_id: int,
	              db: Session = Depends(get_db),
	              token: str = Depends(decodeJWT)):
    """Delete a device"""
    existing_device = getDeviceDb(db, device_id=device_id)
    if existing_device is None:
    	raise HTTPException(status_code=404, detail="Device not found")
    return deleteDevice(db, db_device=existing_device)

@router.get("/{device_id}/ip-info", response_model=DeviceIpInfoOut)
def get_device_ip_info(device_id: int,
	                   db: Session = Depends(get_db),
	                   token: str = Depends(decodeJWT)):
    """Get management IP, console IP and console port information for a device"""
    existing_device = getDeviceDb(db, device_id=device_id)
    if existing_device is None:
    	raise HTTPException(status_code=404, detail="Device not found")
    return getDeviceIpInfo(db, db_device=existing_device)

@router.put("/{device_id}/ip-info")
def update_device_ip_info(device_id: int, ip_info: DeviceIPUpdate,
	                      db: Session = Depends(get_db),
	                      token: str = Depends(decodeJWT)):
    """Update management IP, console IP and console port for a device"""
    existing_device = getDeviceDb(db, device_id=device_id)
    if existing_device is None:
    	raise HTTPException(status_code=404, detail="Device not found")
    return updateDeviceIpInfo(db, db_device=existing_device, update=ip_info)


