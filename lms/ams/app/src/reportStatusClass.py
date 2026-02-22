from sqlalchemy import Boolean, Column, ForeignKey, BigInteger, String, Enum, \
 DateTime, or_, func
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session
from sqlalchemy_utils import EmailType, URLType
from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime, date
from enum import Enum as PyEnum

from config.db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse


class ReportsDb(Base):
    __tablename__ = "reports"

    reportId = Column(BigInteger, primary_key=True, index=True)
    reportName = Column(String(30))
    reportDesc = Column(String(200))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class StatusDb(Base):
    __tablename__ = "status"

    statusId = Column(BigInteger, primary_key=True, index=True)
    status = Column(String(30))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class VariablesDb(Base):
    __tablename__ = "variables"

    variableId = Column(BigInteger, primary_key=True, index=True)
    firstAgreedDate = Column(DateTime)
    agreeDateEnc = Column(DateTime)
    regName = Column(String(50))
    regEmail = Column(String(50))
    regNo = Column(Integer)
    ficscalLastDay = Column(DateTime)
    ficscalLastMonth = Column(DateTime)
    notYetDeleted = Column(Boolean)
    version = Column(Float, default=0.0)
    DV = Column(String(30))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)
