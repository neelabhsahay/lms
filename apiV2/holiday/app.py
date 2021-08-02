from fastapi import APIRouter, Depends, HTTPException, Security
from fastapi.security import HTTPAuthorizationCredentials
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import holidayClass
from auth.auth_handler import security

router = APIRouter(
    prefix="/holiday",
    tags=["holiday"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createHolidayApp(leave: holidayClass.HolidayCreate,
                     db: Session = Depends(get_db),
                     token: HTTPAuthorizationCredentials = Security(security)):
    return holidayClass.insertHoliday(db=db, leave=leave)


@router.put("/update/")
def updateHolidayApp(leave: holidayClass.Holiday):
    return "Welcome!"


@router.get("/get/", response_model=holidayClass.HolidayOut)
def getHolidaysApp(skip: int = 0, limit: int = 100,
                   db: Session = Depends(get_db),
                   token: HTTPAuthorizationCredentials = Security(security)):
    holiday = holidayClass.getHolidays(db, skip=skip, limit=limit)
    return holiday


@router.get("/get/{holidayId}", response_model=holidayClass.HolidayOut)
def getHolidayApp(holidayId: str, db: Session = Depends(get_db),
                  token: HTTPAuthorizationCredentials = Security(security)):
    db_holiday = holidayClass.getHoliday(db, holidayId=holidayId)
    if db_holiday is None:
        raise HTTPException(status_code=404, detail="Holiday not found")
    return db_holiday
