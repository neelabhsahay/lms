from typing import Optional, List
from datetime import datetime, date
from pydantic import BaseModel
from sqlalchemy import Column, Integer, String, DateTime
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import Session

from config.db import Base


class LeaveDb(Base):
    __tablename__ = "leaves"

    leaveId = Column(String(20), primary_key=True, index=True)
    leaveType = Column(String(30))
    leaveMax = Column(Integer)
    leaveProvMax = Column(Integer)
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class LeaveBase(BaseModel):
    leaveType: Optional[str] = None
    leaveMax: Optional[int] = None
    leaveProvMax: Optional[int] = None
    modifiedOn: Optional[date] = None


class LeaveCreate(LeaveBase):

    class Config:
        orm_mode = True


class LeaveUpdate(LeaveBase):
    leaveId: str

    class Config:
        orm_mode = True


class Leave(LeaveBase):
    leaveId: str

    class Config:
        orm_mode = True


class LeaveOut(BaseModel):
    body: List[Leave]
    itemCount: int
    totalCount: int


def getLeave(db: Session, leaveId: str):
    leave = db.query(LeaveDb).filter(LeaveDb.leaveId == leaveId).first()
    if leave is None:
        return None
    else:
        return makeJSONGetResponse(leave, 1)


def getLeaves(db: Session, skip: int = 0, limit: int = 100):
    leaves = db.query(LeaveDb).offset(skip).limit(limit).all()
    return makeJSONGetResponse(leaves, 1)


def insertLeave(db: Session, leave: LeaveCreate):
    leave = db.query(LeaveDb).order_by(LeaveDb.leaveId.desc()).first()
    if leave is None:
        leaveId = 'LV0001'
    else:
        lastLeaveId = leave.leaveId
        val = lastLeaveId.strip('LV')
        leaveId = 'LV' + ('%04d') % (int(val) + 1)
    leaveDb = LeaveDb(**leave.dict(exclude_unset=True), leaveId=leaveId)
    try:
        db.add(leaveDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Leave",
                                      "error", error)
    else:
        db.refresh(leaveDb)
        return makeJSONInsertResponse("passed", "Leave record was inserted.",
                                      "leaveId", leaveId)


def updateLeave(db: Session, db_leave: LeaveDb, updates: LeaveUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_leave, var, value) if value else None
    try:
        db.add(db_leave)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to update Leave",
                                      "error", error)
    else:
        db.refresh(db_leave)
        return makeJSONInsertResponse("passed",
                                      "Leave record was updated.",
                                      "empId", leave.leaveId)


def deleteLeave(db: Session, leaveId: str):
    affected_rows = db.query(
            LeaveDb).filter(LeaveDb.leaveId == leaveId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Employee record was deleted.",
                                  "empId", empId)
