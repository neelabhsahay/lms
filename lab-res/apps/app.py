#!/usr/bin/python3
"""
FastAPI application for Lab Resource Management
Provides REST API endpoints for Host, Device, and Port tables
"""

from fastapi import Depends, FastAPI, HTTPException, Depends
from fastapi.middleware.cors import CORSMiddleware
from sqlalchemy.orm import Session
from pydantic import BaseModel, Field
from typing import Optional, List
from datetime import datetime

from config.Db import get_db

from admin.host.app import router as hostRouter
from admin.asic.app import router as asicRouter
from admin.device.app import router as deviceRouter
from admin.port.app import router as portRouter
from admin.user.app import router as userRouter

from login import router as loginRouter

# FastAPI app initialization
app = FastAPI(title="Lab Resource Management API", version="1.0.0")

origins = [
    "http://localhost",
    "http://localhost:8080",
    "http://192.168.66.19:8000",
    "http://192.168.66.9:8000",
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


app.include_router(hostRouter)
app.include_router(asicRouter)
app.include_router(portRouter)
app.include_router(deviceRouter)
app.include_router(loginRouter)
app.include_router(userRouter)

# ==================== UTILITY ENDPOINTS ====================

@app.get("/")
def main():
    """API root endpoint"""
    return {
    	"message": "Lab Resource Management API",
    	"version": "1.0.0",
    	"endpoints": {
    	    "hosts": "/hosts",
    	    "asics": "/asics",
            "devices": "/devices",
    	    "ports": "/ports",
    	    "host_devices_ports": "/hosts/{host_id}/devices-and-ports",
    	    "connected_hosts": "/hosts/{host_id}/connected-hosts",
    	    "reserve_host": "/hosts/{host_id}/reserve",
    	    "free_host": "/hosts/{host_id}/free",
    	    "host_ip_info": "/hosts/{host_id}/ip-info",
    	    "device_ip_info": "/devices/{device_id}/ip-info",
    	    "docs": "/docs"
        }
    }

@app.get("/health")
def health_check(db: Session = Depends(get_db)):
    """Health check endpoint"""
    try:
        with get_db_connection() as conn:
            cursor = conn.cursor()
            cursor.execute("SELECT 1")
            cursor.close()
        return {"status": "healthy", "database": "connected"}
    except Exception as e:
        raise HTTPException(status_code=503, detail=f"Database unhealthy: {str(e)}")

# First make a alias for the IP
# sudo ifconfig lo0 alias 127.0.0.2
# IP_ADD = '127.0.0.2'
# PORT = 80


IP_ADD = '0.0.0.0'
PORT = 8000

if __name__ == '__main__':
    import uvicorn
    uvicorn.run(app='app:app', host=IP_ADD, port=PORT, reload=True)
