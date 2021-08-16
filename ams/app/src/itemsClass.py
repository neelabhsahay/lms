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


class ItemsDb(Base):
    __tablename__ = "items"

    itemId = Column(BigInteger, primary_key=True, index=True)
    name = Column(String(50))
    categoryId = Column(BigInteger)
    deliveryId = Column(BigInteger)
    subCategoryId = Column(BigInteger)
    isExpired = Column(Boolean)
    barcode = Column(BigInteger)
    serialNo = Column(BigInteger)
    description = Column(String(200))
    hasAtrribute = Coulmn(Boolean)
    productCode = Column(String(30))
    manufactureId = Column(BigInteger)
    brandId = Column(BigInteger)
    deleted = Coulmn(Boolean)
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class AttributeDb(Base):
    __tablename__ = "attribute"

    attributeId = Column(BigInteger, primary_key=True, index=True)
    propertyField = Column(String(50))
    propertyValue = Column(String(50))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class AttributeItemsDb(Base):
    __tablename__ = "attribute_items"

    attributeId = Column(BigInteger)
    itemId = Column(BigInteger)
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class DepreciationDb(Base):
    __tablename__ = "depreciation"

    depreciationId = Column(BigInteger, primary_key=True, index=True)
    itemId = Column(BigInteger)
    depreciationDate = Column(DateTime)
    depreciationAmount = Column(Float, default=0.0)
    bookValue = Column(Float, default=0.0)
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class MaintenancesDb(Base):
    __tablename__ = "maintenances"

    maintenanceId = Column(BigInteger)
    itemId = Column(BigInteger)
    maintenanceDate = Column(DateTime)
    maintenanceDescription = Column(String(200))
    maintenancePerformedBy = Column(String(50))
    maintenanceCost = Column(Float, default=0.0)
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)
