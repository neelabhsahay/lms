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


class StocksDb(Base):
    __tablename__ = "stocks"

    stockId = Column(BigInteger, primary_key=True, index=True)
    name = Column(String(50))
    itemId = Column(BigInteger)
    quantity = Column(BigInteger)
    location = Column(String(30))
    locationCode = Column(String(30))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)
