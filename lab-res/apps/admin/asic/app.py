#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for Host, Device, and asic tables
"""

from fastapi import FastAPI, HTTPException, Depends, APIRouter
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime
from contextlib import contextmanager

from config.Db import get_db
from admin.asic.asicClass import *

# ==================== ASIC ENDPOINTS ====================

router = APIRouter(
    prefix="/asics",
    tags=["asics"],
    responses={404: {"description": "Not found"}},
)

@router.get("/", response_model=ASICOut)
@router.get("/{asic_id}", response_model=ASICOut)
def get_asic(asic_id: Optional[int] = None, getCount: bool = False,
	     skip: int = 0, limit: int = 100,
	     db: Session = Depends(get_db),
	     token: str = Depends(decodeJWT)):
    """Get a specific asic by ID or all"""
    if (asic_id is None):
    	asics = getASICs(db, getCount=getCount,
    		         skip=skip, limit=limit)
    else:
    	asics = getASIC(db, asic_id=asic_id)
    return asics

@router.post("/")
def create_asic(asic: ASICCreate,
	        db: Session = Depends(get_db),
	        token: str = Depends(decodeJWT)):
    """Create a new ASIC"""
    return insertASIC(db, asic=asic)

@router.put("/{asic_id}")
def update_asic(asic_id: int, asic: ASICUpdate,
	        db: Session = Depends(get_db),
	        token: str = Depends(decodeJWT)):
    """Update an existing aisc"""
    existing_asic = getASICDb(db, asic_id=asic_id)
    if existing_asic is None:
    	raise HTTPException(status_code=404, detail="ASIC not found")
    return updateASICs(db, db_asic=existing_asic, updates=asic)

@router.delete("/{asic_id}")
def delete_asic(asic_id: int,
	        db: Session = Depends(get_db),
	        token: str = Depends(decodeJWT)):
    """Delete a ASIC"""
    existing_asic = getASICDb(db, asic_id=asic_id)
    if existing_asic is None:
    	raise HTTPException(status_code=404, detail="ASIC not found")
    return deleteASIC(db, db_asic=existing_asic)



