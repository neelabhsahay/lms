#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for Host, Device, and Port tables
"""

from fastapi import FastAPI, HTTPException, Depends, APIRouter
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime
from contextlib import contextmanager

from config.Db import get_db
from admin.host.hostClass import *
from auth.auth_handler import getCurrentUsername
# ==================== HOST ENDPOINTS ====================
router = APIRouter(
    prefix="/hosts",
    tags=["hosts"],
    responses={404: {"description": "Not found"}},
)

@router.get("/", response_model=HostOut)
@router.get("/{host_id}", response_model=HostOut)
def get_hosts(host_id: Optional[int] = None, getCount: bool = False,
     	      skip: int = 0, limit: int = 100,
	          db: Session = Depends(get_db),
	           token: str = Depends(decodeJWT)):
    """Get a specific host by ID or all"""
    if (host_id is None):
    	hosts = getHosts(db, getCount=getCount,
    	    	         skip=skip, limit=limit)
    else:
    	hosts = getHost(db, host_id=host_id)
    return hosts

@router.post("/")
def create_host(host: HostCreate,
                db: Session = Depends(get_db),
                token: str = Depends(decodeJWT)):
    """Create a new host"""
    return insertHost(db, host=host)

@router.put("/{host_id}")
def update_host(host_id: int, host: HostUpdate,
                db: Session = Depends(get_db),
                token: str = Depends(decodeJWT)):
    """Update an existing host"""
    existing_host = getHostDb(db, host_id=host_id)
    if existing_host is None:
    	raise HTTPException(status_code=404, detail="Host not found")
    return updateHost(db, db_host=existing_host, updates=host)

@router.delete("/{host_id}")
def delete_host(host_id: int,
                db: Session = Depends(get_db),
                token: str = Depends(decodeJWT)):
    """Delete a host"""
    existing_host = getHostDb(db, host_id=host_id)
    if existing_host is None:
    	raise HTTPException(status_code=404, detail="Host not found")
    return deleteHost(db, db_host=existing_host)

@router.post("/{host_id}/reserve")
@router.post("/{host_id}/reserve/{user}")
def reserve_host(host_id: int, user: str = None,
	         current_user: str = Depends(getCurrentUsername),
	         db: Session = Depends(get_db),
	         token: str = Depends(decodeJWT)):
    """Reserve a host for a specific user"""
    existing_host = getHostDb(db, host_id=host_id)
    if existing_host is None:
    	raise HTTPException(status_code=404, detail="Host not found")
    if user is None:
        reserved_by=current_user
    else:
        reserved_by=user
    return reserveFreeHost(db, db_host=existing_host,updated_by=current_user,
    	                   reserved_by=reserved_by)

@router.post("/{host_id}/free")
@router.post("/{host_id}/free/{user}")
def free_host(host_id: int, user: str = None,
	      current_user: str = Depends(getCurrentUsername),
	      db: Session = Depends(get_db),
	      token: str = Depends(decodeJWT)):
    """Free a previously reserved host"""
    existing_host = getHostDb(db, host_id=host_id)
    if existing_host is None:
    	raise HTTPException(status_code=404, detail="Host not found")
    if user is None:
        reserved_by=current_user
    else:
        reserved_by=user
    return reserveFreeHost(db, db_host=existing_host,
    	                   updated_by=current_user,
    	                   reserved_by=reserved_by, free=True)

@router.get("/{host_id}/ip-info", response_model=dict)
def get_host_ip_info(host_id: int,
                     db: Session = Depends(get_db),
                     token: str = Depends(decodeJWT)):
    """Get management and BMC IP information for a host"""
    existing_host = getHostDb(db, host_id=host_id)
    if existing_host is None:
    	raise HTTPException(status_code=404, detail="Host not found")
    return ipInfoHost(db, db_user=existing_host)

@router.put("/{host_id}/ip-info", response_model=Host)
def update_host_ip_info(host_id: int, ip_info: HostIPUpdate,
     	                db: Session = Depends(get_db),
                        token: str = Depends(decodeJWT)):
    """Update management and BMC IP addresses for a host"""
    existing_host = getHostDb(db, host_id=host_id)
    if existing_host is None:
    	raise HTTPException(status_code=404, detail="Host not found")
    return updateIpInfoHost(db, db_user=existing_host, updates=ip_info,
    	                    reserved_by=token['username'])


# ==================== CUSTOM/RELATIONSHIP ENDPOINTS ====================

@router.get("/{host_id}/devices-and-ports")
def get_host_devices_and_ports(host_id: int,
	                       db: Session = Depends(get_db),
	                       token: str = Depends(decodeJWT)):
    """Get all devices and their ports for a specific host"""
    with get_db_connection() as conn:
        cursor = conn.cursor(dictionary=True)

        # Check if host exists
        cursor.execute("SELECT * FROM host WHERE id = %s", (host_id,))
        host = cursor.fetchone()
        if not host:
            cursor.close()
            raise HTTPException(status_code=404, detail="Host not found")

        # Get all devices on this host
        cursor.execute("SELECT * FROM device WHERE present_on = %s", (host_id,))
        devices = cursor.fetchall()

        # For each device, get its ports
        for device in devices:
            cursor.execute("SELECT * FROM port WHERE present_on = %s", (device['id'],))
            device['ports'] = cursor.fetchall()

        cursor.close()

        return {
            "host": host,
            "devices": devices
        }

@router.get("/{host_id}/connected-hosts")
def get_connected_hosts(host_id: int,
	                db: Session = Depends(get_db),
	                token: str = Depends(decodeJWT)):
    """Get all hosts that are connected to the given host via port connections"""
    with get_db_connection() as conn:
        cursor = conn.cursor(dictionary=True)

        # Check if host exists
        cursor.execute("SELECT * FROM host WHERE id = %s", (host_id,))
        host = cursor.fetchone()
        if not host:
            cursor.close()
            raise HTTPException(status_code=404, detail="Host not found")

        # Complex query to find connected hosts:
        # 1. Get all devices on the given host
        # 2. Get all ports on those devices
        # 3. Find all ports connected to those ports (via port.connected field)
        # 4. Find the devices those connected ports belong to
        # 5. Find the hosts those devices belong to
        query = """
            SELECT DISTINCT h.*
            FROM host h
            INNER JOIN device d ON h.id = d.present_on
            INNER JOIN port p ON d.id = p.present_on
            INNER JOIN port connected_port ON (
                p.connected = connected_port.id OR connected_port.connected = p.id
            )
            INNER JOIN device connected_device ON connected_port.present_on = connected_device.id
            INNER JOIN host connected_host ON connected_device.present_on = connected_host.id
            WHERE h.id = %s AND connected_host.id != %s
        """

        cursor.execute(query, (host_id, host_id))
        connected_hosts = cursor.fetchall()
        cursor.close()

        return {
            "host": host,
            "connected_hosts": connected_hosts,
            "count": len(connected_hosts)
        }

