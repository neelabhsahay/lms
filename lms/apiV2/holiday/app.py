from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from config.db import get_db
from . import holidayClass
from auth.auth_handler import decodeJWT

router = APIRouter(
    prefix="/holiday",
    tags=["holiday"],
    # dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createHolidayApp(holiday: holidayClass.HolidayCreate,
                     db: Session = Depends(get_db),
                     token: str = Depends(decodeJWT)):
    return holidayClass.insertHoliday(db=db, holiday=holiday)


@router.put("/update/{holidayId}")
def updateHolidayApp(holidayId: int, holiday: holidayClass.HolidayUpdate,
                     db: Session = Depends(get_db),
                     token: str = Depends(decodeJWT)):
    existing_holiday = holidayClass.getHolidayDb(db, holidayId=holidayId)
    if existing_holiday is None:
        raise HTTPException(status_code=404, detail="Holiday not found")
    res = holidayClass.updateHoliday(db, db_holiday=existing_holiday,
                                     updates=holiday)
    return res


@router.get("/get/year/{year}", response_model=holidayClass.HolidayOut)
def getHolidayApp(year: int, skip: int = 0, limit: int = 100,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    db_holiday = holidayClass.getHolidayInYear(db, year=year)
    if db_holiday is None:
        raise HTTPException(status_code=404, detail="Holiday not found")
    return db_holiday


@router.get("/get/", response_model=holidayClass.HolidayOut)
def getHolidaysApp(skip: int = 0, limit: int = 100,
                   db: Session = Depends(get_db),
                   token: str = Depends(decodeJWT)):
    holiday = holidayClass.getHolidays(db, skip=skip, limit=limit)
    return holiday


@router.get("/get/{holidayId}", response_model=holidayClass.HolidayOut)
def getHolidayApp(holidayId: int, db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    db_holiday = holidayClass.getHoliday(db, holidayId=holidayId)
    if db_holiday is None:
        raise HTTPException(status_code=404, detail="Holiday not found")
    return db_holiday
