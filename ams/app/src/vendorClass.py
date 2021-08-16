from sqlalchemy import Column, ForeignKey, BigInteger, String, \
 DateTime
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session
from sqlalchemy_utils import EmailType, URLType
from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime, date
from enum import Enum as PyEnum

from config.db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse


class VendorsDb(Base):
    __tablename__ = "vendors"

    vendorId = Column(BigInteger, primary_key=True, index=True)
    vendorName = Column(String(50))
    contactFirstName = Column(String(50))
    contactLastName = Column(String(50))
    address = Column(String(30))
    city = Column(String(30))
    stateOrProvince = Column(String(30))
    postalCode = Column(BigInteger)
    country = Column(String(30))
    phoneNumber = Column(BigInteger)
    faxNumber = Column(BigInteger)
    note = Column(String(200))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)
