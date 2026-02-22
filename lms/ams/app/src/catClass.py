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


class CategoryDb(Base):
    __tablename__ = "category"

    categoryId = Column(BigInteger, primary_key=True, index=True)
    name = Column(String(50))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class DeliveryDb(Base):
    __tablename__ = "delivery"

    deliveryId = Column(BigInteger, primary_key=True, index=True)
    name = Column(String(50))
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class SubCategoryDb(Base):
    __tablename__ = "sub_category"

    subCategoryId = Column(BigInteger, primary_key=True, index=True)
    name = Column(String(50))
    categoryId = Column(BigInteger), ForeignKey("category.categoryId")
    createdOn = Column(DateTime, default=datetime.now)
    modifiedOn = Column(DateTime, onupdate=datetime.now)

    category = relationship("CategoryDb", foreign_keys=[categoryId])


class CategoryBase(BaseModel):
    name: Optional[str] = None
    modifiedOn: Optional[datetime] = None


class CategoryCreate(CategoryBase):
    pass


class CategoryUpdate(CategoryBase):
    categoryId: int

    class Config:
        orm_mode = True


class Category(CategoryBase):
    categoryId: int

    class Config:
        orm_mode = True


class CategoryOut(BaseModel):
    body: List[Category] = []
    itemCount: int
    totalCount: int


class SubCategoryBase(BaseModel):
    name: Optional[str] = None
    modifiedOn: Optional[datetime] = None


class SubCategoryCreate(SubCategoryBase):
    pass


class SubCategoryUpdate(SubCategoryBase):
    subCategoryId: int

    class Config:
        orm_mode = True


class SubCategory(SubCategoryBase):
    subCategoryId: int

    class Config:
        orm_mode = True


class SubCategoryOut(BaseModel):
    body: List[SubCategory] = []
    itemCount: int
    totalCount: int


class DeliveryBase(BaseModel):
    name: Optional[str] = None
    modifiedOn: Optional[datetime] = None


class DeliveryCreate(DeliveryBase):
    pass


class DeliveryUpdate(DeliveryBase):
    deliveryId: int

    class Config:
        orm_mode = True


class Delivery(DeliveryBase):
    deliveryId: int

    class Config:
        orm_mode = True


class DeliveryOut(BaseModel):
    body: List[Delivery] = []
    itemCount: int
    totalCount: int


def getCategoryDb(db: Session, categoryId: int):
    return db.query(CategoryDb).filter(CategoryDb.categoryId == categoryId).first()


def getCategory(db: Session, categoryId: str):
    category = getCategoryDb(db, categoryId=categoryId)
    if category is None:
        return None
    else:
        return makeJSONGetResponse(category, 1)


def getCategorys(db: Session, getCount: bool = False,
                 skip: int = 0, limit: int = 100):
    categorys = db.query(CategoryDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(CategoryDb).count()
    else:
        count = 0
    return makeJSONGetResponse(category, count)


def insertCategory(db: Session, category: CategoryCreate):
    categoryDb = CategoryDb(**category.dict(exclude_unset=True))
    try:
        db.add(categoryDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Category",
                                      "reason", error)
    else:
        db.refresh(categoryDb)
        return makeJSONInsertResponse("passed", "Category was inserted.",
                                      "categoryId", categoryDb.categoryId)


def updateCategory(db: Session, db_category: CategoryDb, updates: CategoryUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_category, var, value) if value else None
    try:
        db.add(db_category)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update Category",
                                      "reason", error)
    else:
        db.refresh(db_category)
        return makeJSONInsertResponse("passed",
                                      "Category record was updated.",
                                      "categoryId", db_category.categoryId)


def deleteCategory(db: Session, categoryId: int):
    affected_rows = db.query(
            CategoryDb).filter(CategoryDb.categoryId == categoryId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Category record was deleted.",
                                  "categoryId", categoryId)


def getSubCategoryDb(db: Session, subCategoryId: int):
    return db.query(SubCategoryDb).filter(
        SubCategoryDb.subCategoryId == subCategoryId).first()


def getSubCategory(db: Session, subCategoryId: str):
    subCategory = getSubCategoryDb(db, subCategoryId=subCategoryId)
    if subCategory is None:
        return None
    else:
        return makeJSONGetResponse(subCategory, 1)


def getSubCategorys(db: Session, getCount: bool = False,
                    skip: int = 0, limit: int = 100):
    categorys = db.query(CategoryDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(CategoryDb).count()
    else:
        count = 0
    return makeJSONGetResponse(category, count)


def insertSubCategory(db: Session, subCategory: SubCategoryCreate):
    subCategoryDb = SubCategoryDb(**subCategory.dict(exclude_unset=True))
    try:
        db.add(subCategoryDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Category",
                                      "reason", error)
    else:
        db.refresh(subCategoryDb)
        return makeJSONInsertResponse("passed", "Category was inserted.",
                                      "categoryId", subCategoryDb.subCategoryId)


def updateSubCategory(db: Session, db_subCategory: SubCategoryDb,
                      updates: SubCategoryUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_subCategory, var, value) if value else None
    try:
        db.add(db_subCategory)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update Category",
                                      "reason", error)
    else:
        db.refresh(db_subCategory)
        return makeJSONInsertResponse("passed",
                                      "Category record was updated.",
                                      "categoryId", db_subCategory.subCategoryId)


def deleteSubCategory(db: Session, subCategoryId: int):
    affected_rows = db.query(
            SubCategoryDb).filter(SubCategoryDb.subCategoryId == subCategoryId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Category record was deleted.",
                                  "subCategoryId", subCategoryId)


def getDeliveryDb(db: Session, deliveryId: int):
    return db.query(DeliveryDb).filter(
        DeliveryDb.deliveryId == deliveryId).first()


def getDelivery(db: Session, deliveryId: int):
    delivery = getDeliveryDb(db, deliveryId=deliveryId)
    if delivery is None:
        return None
    else:
        return makeJSONGetResponse(delivery, 1)


def getDeliverys(db: Session, getCount: bool = False,
                 skip: int = 0, limit: int = 100):
    deliverys = db.query(DeliveryDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(DeliveryDb).count()
    else:
        count = 0
    return makeJSONGetResponse(Deliverys, count)


def insertDelivery(db: Session, delivery: DeliveryCreate):
    deliveryDb = DeliveryDb(**delivery.dict(exclude_unset=True))
    try:
        db.add(deliveryDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Delivery",
                                      "reason", error)
    else:
        db.refresh(deliveryDb)
        return makeJSONInsertResponse("passed", "Delivery was inserted.",
                                      "deliveryId", deliveryDb.deliveryId)


def updateDelivery(db: Session, db_delivery: DeliveryDb,
                   updates: DeliveryUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_delivery, var, value) if value else None
    try:
        db.add(db_delivery)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update Delivery",
                                      "reason", error)
    else:
        db.refresh(db_delivery)
        return makeJSONInsertResponse("passed",
                                      "Delivery record was updated.",
                                      "deliveryId", db_delivery.deliveryId)


def deleteDelivery(db: Session, deliveryId: int):
    affected_rows = db.query(
            DeliveryDb).filter(DeliveryDb.deliveryId == deliveryId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Delivery record was deleted.",
                                  "deliveryId", deliveryId)

