from enum import Enum as PyEnum
from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime, date

from sqlalchemy import Boolean, Column, ForeignKey, BigInteger, String, Enum, \
 DateTime
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session

from config.db import Base


class UserDb(Base):
    __tablename__ = "login"

    empId = Column(String(30))
    username = Column(String(50), primary_key=True, index=True)
    password = Column(String(200))
    email = Column(String(40))
    passwordType = Column(Enum('TP', 'PR'))
    accountType = Column(Enum('EMP', 'ADM', 'SUP'))
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class PasswordType(str, PyEnum):
    TP = 'TP'
    PR = 'PR'


class AccountType(str, PyEnum):
    EMP = 'EMP'
    ADM = 'ADM'
    SUP = 'SUP'


class UserBase(BaseModel):
    empId: str
    username: str
    passwordType: Optional[PasswordType] = None
    accountType: Optional[AccountType] = None
    email: Optional[str] = None
    modifiedOn: Optional[datetime] = None


class UserCreate(UserBase):
    # has this password
    password: str
    pass


class User(UserBase):
    class Config:
        orm_mode = True
        use_enum_values = True


class UserOut(BaseModel):
    body: List[User] = []
    itemCount: int
    totalCount: int


def getUser(db: Session, username: str):
    user = db.query(UserDb).filter(UserDb.username == username).first()
    if user is None:
        return None
    else:
        return makeJSONGetResponse(user, 1)


def getUsers(db: Session, skip: int = 0, limit: int = 100):
    users = db.query(UserDb).offset(skip).limit(limit).all()
    return makeJSONGetResponse(users, 1)
