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


class NotificationDb(Base):
    __tablename__ = "notification"

    notificationId = Column(BigInteger, primary_key=True, index=True)
    empId = Column(String(30))
    itemId = Column(BigInteger)
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class FileLinksDb(Base):
    __tablename__ = "fileLinks"

    attachmentId = Column(BigInteger, primary_key=True, index=True)
    recordType = Column(String(30))
    recordId = Column(BigInteger)
    fileLink = Column(String(50))
    fileName = Column(String(100))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)
