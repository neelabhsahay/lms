from typing import Optional, List
from datetime import datetime, date
from pydantic import BaseModel
from sqlalchemy import Column, Integer, String, DateTime, Date
from sqlalchemy.dialects.mysql import YEAR
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import Session

from config.db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse


class HolidayDb(Base):
    __tablename__ = "holidays"

    holidayId = Column(Integer, primary_key=True, index=True)
    holidayName = Column(String(100))
    holidayDate = Column(DateTime)
    year = Column(YEAR, default=datetime.now().year)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class HolidayBase(BaseModel):
    holidayName: str
    holidayDate: date
    year:  Optional[int] = None


class HolidayCreate(HolidayBase):

    class Config:
        orm_mode = True


class HolidayUpdate(HolidayBase):
    holidayId: int

    class Config:
        orm_mode = True


class Holiday(HolidayBase):
    holidayId: int

    class Config:
        orm_mode = True


class HolidayOut(BaseModel):
    body: List[Holiday]
    itemCount: int
    totalCount: int


def getHolidayDb(db: Session, holidayId: int):
    return db.query(HolidayDb).filter(HolidayDb.holidayId == holidayId).first()


def getHoliday(db: Session, holidayId: int):
    holiday = getHolidayDb(db, holidayId=holidayId)
    if holiday is None:
        return None
    else:
        return makeJSONGetResponse(holiday, 1)


def getHolidays(db: Session, skip: int = 0, limit: int = 100):
    holidays = db.query(HolidayDb).offset(skip).limit(limit).all()
    return makeJSONGetResponse(holidays, 1)


def getHolidayInYear(db: Session, year: int,
                     skip: int = 0, limit: int = 100):
    holidays = db.query(HolidayDb).filter(
           HolidayDb.year == year).offset(skip).limit(limit).all()
    return makeJSONGetResponse(holidays, 1)


def insertHoliday(db: Session, holiday: HolidayCreate):
    holidayDb = HolidayDb(**holiday.dict(exclude_unset=True))
    try:
        db.add(holidayDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Holiday",
                                      "reason", error)
    else:
        db.refresh(holidayDb)
        return makeJSONInsertResponse("passed", "Holiday record was inserted.",
                                      "holidayId", holidayDb.holidayId)


def updateHoliday(db: Session, db_holiday: HolidayDb, updates: HolidayUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_holiday, var, value) if value else None
    try:
        db.add(db_holiday)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update Holiday",
                                      "reason", error)
    else:
        db.refresh(db_holiday)
        return makeJSONInsertResponse("passed",
                                      "Holiday record was updated.",
                                      "holidayId", db_holiday.holidayId)


def deleteHoliday(db: Session, holidayId: str):
    affected_rows = db.query(
            HolidayDb).filter(HolidayDb.holidayId == holidayId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Holiday record was deleted.",
                                  "holidayId", holidayId)
