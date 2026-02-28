from enum import Enum as PyEnum
from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime, date
import bcrypt
from sqlalchemy import Boolean, Column, ForeignKey, Integer, String, Enum, \
 DateTime
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session

from config.Db import Base
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse


class UserDb(Base):
    __tablename__ = "users"
    id = Column(Integer(), primary_key=True)
    username = Column(String(50), unique=True, nullable=False)
    password_hash = Column(String(200))
    email = Column(String(40))
    deleted = Column(Boolean)
    password_type = Column(Enum('TP', 'PR'), default='TP')
    privilege_level = Column(Enum('user', 'editor', 'admin'), default='user')
    modified_at = Column(DateTime, onupdate=datetime.now)


class PasswordType(str, PyEnum):
    TP = 'TP'
    PR = 'PR'


class PrivilegeLevel(str, PyEnum):
    USR = 'user'
    EDI = 'editor'
    ADM = 'admin'


class UserBase(BaseModel):
    username: str
    deleted: Optional[bool] = None
    password_type: Optional[PasswordType] = None
    privilege_level: Optional[PrivilegeLevel] = None
    email: Optional[str] = None
    modified_at: Optional[datetime] = None


class UserCreate(UserBase):
    # has this password
    password: str
    pass


class UserUpdate(UserBase):
    pass


class User(UserBase):
    class Config:
        orm_mode = True
        use_enum_values = True


class UserOut(BaseModel):
    body: List[User] = []
    itemCount: int
    totalCount: int


class UserLogin(BaseModel):
    username: str
    password: str


def getUserDb(db: Session, username: str):
    return db.query(UserDb).filter(UserDb.username == username).first()


def getUser(db: Session, username: str):
    user = getUserDb(db, username=username)
    if user is None:
        return None
    else:
        return makeJSONGetResponse(user, 1)


def getUsers(db: Session, getCount: bool = False,
             skip: int = 0, limit: int = 100):
    users = db.query(UserDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(UserDb).count()
    else:
        count = 0
    return makeJSONGetResponse(users, count)


def insertUser(db: Session, user: UserCreate):
    hashed_password = bcrypt.hashpw(user.password.encode('utf-8'),
                                    bcrypt.gensalt())
    userDetail = user.dict(exclude_unset=True)
    userDetail['password'] = hashed_password
    userDb = UserDb(**userDetail)
    try:
        db.add(userDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to create new user",
                                      "reason", error)
    else:
        db.refresh(userDb)
        return makeJSONInsertResponse("passed", "New user is created.",
                                      "username", user.username)


def updateUser(db: Session, db_user: UserDb, updates: UserUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_user, var, value) if value else None
    try:
        db.add(db_user)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update user",
                                      "reason", error)
    else:
        db.refresh(db_user)
        return makeJSONInsertResponse("passed",
                                      "User record is updated.",
                                      "username", db_user.username)
