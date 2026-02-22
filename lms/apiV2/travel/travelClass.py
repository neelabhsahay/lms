from typing import Optional, List
from datetime import datetime, date
from pydantic import BaseModel
from sqlalchemy import Column, Integer, BigInteger, String, DateTime
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import Session

from config.db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse


class TravelRequestDb(Base):
    __tablename__ = "travel_requests"

    travelReqId = Column(Integer, primary_key=True, index=True)
    empId = Column(String(30))
    travelType = Column(String(50))
    origin = Column(String(50))
    destination = Column(String(50))
    tripStartDate = Column(DateTime)
    tripEndDat = Column(DateTime)
    orgVp = Column(String(50))
    travelPropose = Column(String(50))
    travelJustification = Column(String(200))
    status = Column(Enum('Pending', 'Approved', 'Rejected'), default='Pending')
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, default=datetime.now, onupdate=datetime.now)


class TravelRequestStatusDb(Base):
    __tablename__ = "travel_request_status"

    travelReqStatusId = Column(BigInteger, primary_key=True, index=True)
    travelReqId = Column(Integer)
    reason = Column(String(200))
    modifiedby = Column(String(30))
    state = Column(Enum('Pending', 'Approved', 'Rejected'), default='Pending')
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, default=datetime.now, onupdate=datetime.now)


class TravelExpenseDb(Base):
    __tablename__ = "travel_expense"

    travelExpenseId = Column(BigInteger, primary_key=True, index=True)
    travelReqId = Column(Integer)
    date = Column(DateTime)
    amount = Column(Float)
    description = Column(String(200))
    currency = Column(String(20))
    exchangeRate = Column(Float)
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, default=datetime.now, onupdate=datetime.now)
