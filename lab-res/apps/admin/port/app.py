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
from admin.port.portClass import *

# ==================== PORT ENDPOINTS ====================

router = APIRouter(
    prefix="/ports",
    tags=["ports"],
    responses={404: {"description": "Not found"}},
)

@router.get("/", response_model=PortOut)
@router.get("/{port_id}", response_model=PortOut)
def get_port(port_id: Optional[int] = None, getCount: bool = False,
	     skip: int = 0, limit: int = 100,
	     db: Session = Depends(get_db),
	     token: str = Depends(decodeJWT)):
    """Get a specific port by ID or all"""
    if (port_id is None):
    	ports = getPorts(db, getCount=getCount,
    		         skip=skip, limit=limit)
    else:
    	ports = getPort(db, port_id=port_id)
    return ports

@router.post("/")
def create_port(port: PortCreate,
	            db: Session = Depends(get_db),
	            token: str = Depends(decodeJWT)):
    """Create a new port"""
    return insertPort(db, port=port)

@router.put("/{port_id}")
def update_port(port_id: int, port: PortUpdate,
	            db: Session = Depends(get_db),
	            token: str = Depends(decodeJWT)):
    """Update an existing port"""
    existing_port = getPortDb(db, port_id=port_id)
    if existing_port is None:
    	raise HTTPException(status_code=404, detail="Port not found")
    return updatePort(db, db_port=existing_port, updates=port)

@router.delete("{port_id}")
def delete_port(port_id: int,
	            db: Session = Depends(get_db),
	            token: str = Depends(decodeJWT)):
    """Delete a port"""
    existing_port = getPortDb(db, port_id=port_id)
    if existing_port is None:
    	raise HTTPException(status_code=404, detail="Port not found")
    return deletePort(db, db_port=existing_port)



