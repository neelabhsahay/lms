from typing import Optional, List
from pydantic import BaseModel
from datetime import datetime, date
from enum import Enum as PyEnum

from sqlalchemy import Column, ForeignKey, Integer, String, DateTime, Float, \
Enum
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session
from sqlalchemy.sql import text

from config.db import Base
from leave.leaveClass import LeaveDb, Leave
from emp.empClass import EmployeeDb, Employee
from libs.utils import makeJSONGetResponse, makeJSONInsertResponse


class LeaveRequestDb(Base):
    __tablename__ = "emp_leaves_request"

    reqId = Column(Integer, primary_key=True, index=True)
    leaveId = Column(String(20),  ForeignKey("leaves.leaveId"))
    empId = Column(String(30), ForeignKey("employees.empId"))
    year = Column(Integer, default=date.today().year)
    appliedBy = Column(String(30), ForeignKey("employees.empId"))
    approver = Column(String(30), ForeignKey("employees.empId"))
    appliedDate = Column(DateTime, default=datetime.now)
    leaveDays = Column(Float)
    startDate = Column(DateTime)
    endDate = Column(DateTime)
    reason = Column(String(400), default='')
    status = Column(Enum('Pending', 'Approved', 'Rejected'), default='Pending')
    leaveRqtState = Column(Enum('Applied', 'Revoke'), default='Applied')
    modifiedOn = Column(DateTime, onupdate=datetime.now)

    leave = relationship("LeaveDb", foreign_keys=[leaveId])
    employee = relationship("EmployeeDb", foreign_keys=[empId])
    approverDetails = relationship("EmployeeDb", foreign_keys=[approver])


class LeaveRequestStatus(str, PyEnum):
    Pending = 'Pending'
    Approved = 'Approved'
    Rejected = 'Rejected'


class LeaveRequestState(str, PyEnum):
    Applied = 'Applied'
    Revoke = 'Revoke'


class LeaveRequestBase(BaseModel):
    leaveId: str
    empId: str
    year: int
    appliedBy: str
    approver: str
    appliedDate: Optional[date] = None
    leaveDays: float
    startDate: date
    endDate: date
    reason: Optional[str] = None
    status: Optional[LeaveRequestStatus] = None
    leaveRqtState: Optional[LeaveRequestState] = None
    modifiedOn: Optional[datetime] = None


class LeaveRequestCreate(LeaveRequestBase):
    pass


class LeaveRequest(LeaveRequestBase):
    reqId: int
    leaveType: str
    firstName: str
    lastName: str
    approverName: str

    class Config:
        orm_mode = True


class LeaveRequestOut(BaseModel):
    body: List[LeaveRequest]
    itemCount: int
    totalCount: int


def getLeaveRequestObj(lvDb: LeaveRequestDb):
    approverName = lvDb.approverDetails.firstName + ' ' + \
                   lvDb.approverDetails.lastName
    return LeaveRequest(**lvDb.__dict__,
                        leaveType=lvDb.leave.leaveType,
                        firstName=lvDb.employee.firstName,
                        lastName=lvDb.employee.lastName,
                        approverName=approverName)


def getLeaveRequest(db: Session, reqId: str):
    leaveRq = db.query(LeaveRequestDb).filter(
        LeaveRequestDb.reqId == reqId).first()
    return makeJSONGetResponse(getLeaveRequestObj(leaveRq), 1)


def getLeaveRequests(db: Session, skip: int = 0, limit: int = 100):
    leaveRqDb = db.query(LeaveRequestDb).offset(skip).limit(limit).all()
    leaveRqList = list()
    for leaveRq in leaveRqDb:
        leaveRqList.append(getLeaveRequestObj(leaveRq))
    return makeJSONGetResponse(leaveRqList, 1)


def getLeaveForApprove(db: Session, approver: str, skip: int = 0,
                       limit: int = 100):
    leaveRqDb = db.query(LeaveRequestDb).filter(
        LeaveRequestDb.approver == approver).offset(skip).limit(limit).all()
    leaveRqList = list()
    for leaveRq in leaveRqDb:
        leaveRqList.append(getLeaveRequestObj(leaveRq))
    return makeJSONGetResponse(leaveRqList, 1)


def getLeaveForEmployee(db: Session, empId: str, skip: int = 0,
                        limit: int = 100):
    leaveRqDb = db.query(LeaveRequestDb).filter(
        LeaveRequestDb.empId == empId).offset(skip).limit(limit).all()
    leaveRqList = list()
    for leaveRq in leaveRqDb:
        leaveRqList.append(getLeaveRequestObj(leaveRq))
    return makeJSONGetResponse(leaveRqList, 1)


def insertLeaveRequest(db: Session, lvRqst: LeaveRequestCreate):
    leaveRqstDb = LeaveRequestDb(**lvRqst.dict(exclude_unset=True))

    key = {
           "leaveDays": lvRqst.leaveDays,
           "empId": lvRqst.empId,
           "leaveId": lvRqst.leaveId,
           "year": lvRqst.year
           }
    statement = text("""UPDATE emp_leaves_status SET
                        leaveUsed = leaveUsed + :leaveDays
                        WHERE empId = :empId AND leaveId = :leaveId
                        AND year = :year""")
    try:
        db.execute(statement, params=key)
        db.add(leaveRqstDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Leave",
                                      "error", error)
    else:
        db.refresh(leaveRqstDb)
        return makeJSONInsertResponse("passed", "Leave record was inserted.",
                                      "reqId",
                                      leaveRqstDb.reqId)


def approveLeaveRequest(db: Session, db_lvrq: LeaveRequestDb):
    key = {
           "leaveDays": lvRqst.leaveDays,
           "empId": lvRqst.empId,
           "leaveId": lvRqst.leaveId,
           "year": lvRqst.year
           }
    statement = text("""UPDATE emp_leaves_status SET
                        leaveUsed = leaveUsed + :leaveDays
                        WHERE empId = :empId AND leaveId = :leaveId
                        AND year = :year""")
    try:
        db.execute(statement, params=key)
        db.add(leaveRqstDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Leave",
                                      "error", error)
    else:
        db.refresh(leaveRqstDb)
        return makeJSONInsertResponse("passed", "Leave record was inserted.",
                                      "reqId",
                                      leaveRqstDb.reqId)
