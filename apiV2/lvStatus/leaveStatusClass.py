from typing import Optional, List
from pydantic import BaseModel, Field
from datetime import datetime, date
from sqlalchemy import Column, ForeignKey, Integer, String, DateTime, Float
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session

from config.db import Base
from leave.leaveClass import LeaveDb, Leave
from emp.empClass import EmployeeDb, Employee
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse


class LeaveStatusDb(Base):
    __tablename__ = "emp_leaves_status"

    leaveId = Column(String(20), ForeignKey("leaves.leaveId"),
                     primary_key=True, index=True)
    empId = Column(String(30), ForeignKey("employees.empId"),
                   primary_key=True, index=True)
    year = Column(Integer, primary_key=True, index=True,
                  default=date.today().year)
    leaveCarried = Column(Float, default=0.0)
    leaveInYear = Column(Float, default=0.0)
    leaveUsed = Column(Float, default=0.0)
    modifiedBy = Column(String(30))
    modifiedOn = Column(DateTime, onupdate=datetime.now)

    leave = relationship("LeaveDb")
    employee = relationship("EmployeeDb")


class LeaveStatusBase(BaseModel):
    leaveId: str
    empId: str
    year: int
    modifiedBy: str
    leaveCarried: Optional[float] = None
    leaveInYear: Optional[float] = None
    leaveUsed: Optional[float] = None


class LeaveStatusKey(BaseModel):
    leaveId: str
    empId: str
    year: int


class LeaveStatusCreate(LeaveStatusBase):
    pass


class LeaveStatusUpdate(LeaveStatusBase):
    pass


class LeaveStatus(LeaveStatusBase):
    leaveType: str
    firstName: str
    lastName: str

    class Config:
        orm_mode = True


class LeaveStatusOut(BaseModel):
    body: List[LeaveStatus]
    itemCount: int
    totalCount: int


def getLeaveStatusObj(lvDb: LeaveStatusDb):
    return LeaveStatus(**lvDb.__dict__,
                       leaveType=lvDb.leave.leaveType,
                       firstName=lvDb.employee.firstName,
                       lastName=lvDb.employee.lastName)


def getLeaveStatusResponse(lvStatus):
    if isinstance(lvStatus, list):
        reList = list()
        for lvDb in lvStatus:
            reList.append(getLeaveStatusObj(lvDb))
        return reList
    else:
        return getLeaveStatusObj(lvStatus)


def getLeaveStatus(db: Session, key: LeaveStatusKey):
    leaveSt = db.query(LeaveStatusDb).filter(
                       LeaveStatusDb.leaveId == key.leaveId,
                       LeaveStatusDb.empId == key.empId,
                       LeaveStatusDb.year == key.year).first()
    if leaveSt is None:
        return None
    else:
        return makeJSONGetResponse(getLeaveStatusResponse(leaveSt), 1)


def getLeavesStatus(db: Session, skip: int = 0, limit: int = 100):
    leavesSt = db.query(LeaveStatusDb).offset(skip).limit(limit).all()
    return makeJSONGetResponse(getLeaveStatusResponse(leavesSt), 1)


def insertLeaveStatus(db: Session, leaveStatus: LeaveStatusCreate):
    leaveStatusDb = LeaveStatusDb(**leaveStatus.dict(exclude_unset=True))
    try:
        db.add(leaveStatusDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert leavestatus",
                                      "error", error)
    else:
        db.refresh(leaveStatusDb)
        return makeJSONInsertResponse("passed",
                                      "Leave Status record was inserted.",
                                      ["year", 'empId', 'leaveId'],
                                      [leaveStatus.year, leaveStatus.empId,
                                       leaveStatus.leaveId])


def updateLeaveStatus(db: Session, db_lvst: LeaveStatusDb,
                      updates: LeaveStatusUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_lvst, var, value) if value else None
    try:
        db.add(db_lvst)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed",
                                      "Unable to update leave status record",
                                      "error", error)
    else:
        db.refresh(db_lvst)
        return makeJSONInsertResponse("passed",
                                      "Leave Status record was updated.",
                                      ["year", 'empId', 'leaveId'],
                                      [updates.year, updates.empId,
                                       updates.leaveId])


def deleteLeaveStatus(db: Session, key: LeaveStatusKey):
    affected_rows = db.query(LeaveStatusDb).filter(
        LeaveStatusDb.empId == key.empId and
        LeaveStatusDb.leaveId == key.leaveId and
        LeaveStatusDb.year == key.year).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Leave Status record was deleted.",
                                  ["year", 'empId', 'leaveId'],
                                  [key.year, key.empId, key.leaveId])
