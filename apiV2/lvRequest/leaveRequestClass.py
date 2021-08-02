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
from lvStatus.leaveStatusClass import getLeaveStatusDb, LeaveStatusKey
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


class LeaveRequestApprove(BaseModel):
    reqId: int
    status: LeaveRequestStatus


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


def getLeaveRequestDb(db: Session, reqId: str):
    return db.query(LeaveRequestDb).filter(
        LeaveRequestDb.reqId == reqId).first()


def getLeaveRequest(db: Session, reqId: str):
    leaveRq = getLeaveRequestDb(db, reqId=reqId)
    return makeJSONGetResponse(getLeaveRequestObj(leaveRq), 1)


def getLeaveRequests(db: Session, getCount: bool = False,
                     skip: int = 0, limit: int = 100):
    leaveRqDb = db.query(LeaveRequestDb).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(LeaveRequestDb).count()
    else:
        count = 1
    leaveRqList = list()
    for leaveRq in leaveRqDb:
        leaveRqList.append(getLeaveRequestObj(leaveRq))
    return makeJSONGetResponse(leaveRqList, count)


def getLeaveForApprove(db: Session, approver: str, getCount: bool = False,
                       skip: int = 0, limit: int = 100):
    leaveRqDb = db.query(LeaveRequestDb).filter(
        LeaveRequestDb.approver == approver).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(LeaveRequestDb).filter(
            LeaveRequestDb.approver == approver).count()
    else:
        count = 1
    leaveRqList = list()
    for leaveRq in leaveRqDb:
        leaveRqList.append(getLeaveRequestObj(leaveRq))
    return makeJSONGetResponse(leaveRqList, 1)


def getLeaveFromEmployee(db: Session, empId: str, getCount: bool = False,
                         skip: int = 0, limit: int = 100):
    leaveRqDb = db.query(LeaveRequestDb).filter(
        LeaveRequestDb.empId == empId).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(LeaveRequestDb).filter(
            LeaveRequestDb.empId == empId).count()
    else:
        count = 1
    leaveRqList = list()
    for leaveRq in leaveRqDb:
        leaveRqList.append(getLeaveRequestObj(leaveRq))
    return makeJSONGetResponse(leaveRqList, count)


def insertLeaveRequest(db: Session, lvRqst: LeaveRequestCreate):
    leaveRqstDb = LeaveRequestDb(**lvRqst.dict(exclude_unset=True))
    key = {
           "empId": lvRqst.empId,
           "leaveId": lvRqst.leaveId,
           "year": lvRqst.year
           }
    lvStatusKey = LeaveStatusKey(**key)
    db_lvStatus = getLeaveStatusDb(db, lvStatusKey)

    # check wether enough leave avialable
    leavePresent = (db_lvStatus.leaveCarried + db_lvStatus.leaveInYear) - \
                    db_lvStatus.leaveUsed
    if leavePresent < lvRqst.leaveDays:
        return makeJSONInsertResponse("failed", "Not enough leave avialable",
                                      ['asked', 'avialable', 'empId',
                                       'leaveId', 'year'],
                                      [lvRqst.leaveDays, leavePresent,
                                       lvRqst.empId, lvRqst.leaveId,
                                       lvRqst.year])

    key["leaveDays"] = lvRqst.leaveDays

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
                                      "reason", error)
    else:
        db.refresh(leaveRqstDb)
        return makeJSONInsertResponse("passed", "Leave record was inserted.",
                                      "reqId",
                                      leaveRqstDb.reqId)


def approveLeaveRequest(db: Session, lvRqst: LeaveRequestApprove):
    db_leaveRq = leaveRequestClass.getLeaveRequestDb(db, reqId=lvRqst.reqId)
    if db_leaveRq is None:
        return None
    else:
        # if already in same state just bail out
        if db_leaveRq.status == lvRqst.status:
            return makeJSONInsertResponse("passed",
                                          "Leave record is approved/rejected.",
                                          "reqId",
                                          db_leaveRq.reqId)
        # if the request is getting rejected update leave used
        if lvRqst.status == 'Rejected':
            key = {
                  "leaveDays": db_leaveRq.leaveDays,
                  "empId": db_leaveRq.empId,
                  "leaveId": db_leaveRq.leaveId,
                  "year": db_leaveRq.year
                  }
            statement = text("""UPDATE emp_leaves_status SET
                                leaveUsed = leaveUsed - :leaveDays
                                WHERE empId = :empId AND leaveId = :leaveId
                                AND year = :year""")

        setattr(db_leaveRq, 'leaveRqtState', 'Revoke')

        try:
            if lvRqst.status == 'Rejected':
                db.execute(statement, params=key)
            db.add(db_leaveRq)
            db.commit()
        except SQLAlchemyError as e:
            db.rollback()
            error = str(e.__dict__['orig'])
            return makeJSONInsertResponse("failed",
                                          "Unable to approve/reject Leave",
                                          "reason", error)
        else:
            db.refresh(db_leaveRq)
            return makeJSONInsertResponse("passed",
                                          "Leave record is approved/rejected.",
                                          "reqId",
                                          db_leaveRq.reqId)


def revokeLeaveReqest(db: Session, reqId: int):
    db_leaveRq = getLeaveRequestDb(db, reqId=reqId)
    if db_leaveRq is None:
        return None
    else:
        # if already revoked just bail
        if db_leaveRq.leaveRqtState == LeaveRequestState.Revoke:
            return makeJSONInsertResponse("passed",
                                          "Leave request revoked",
                                          "reqId", reqId)
        startDate = db_leaveRq.startDate
        presentDate = date.today()
        # we can only revoke a leave if its not yet passed
        if(presentDate > startDate):
            return makeJSONInsertResponse(
                "failed",
                "Leave Start date: %s is less than today" % startDate,
                ['startDate', 'today'],
                [startDate, presentDate])
        else:
            key = {
                  "leaveDays": db_leaveRq.leaveDays,
                  "empId": db_leaveRq.empId,
                  "leaveId": db_leaveRq.leaveId,
                  "year": db_leaveRq.year
                  }
            statement = text("""UPDATE emp_leaves_status SET
                        leaveUsed = leaveUsed - :leaveDays
                        WHERE empId = :empId AND leaveId = :leaveId
                        AND year = :year""")

            setattr(db_leaveRq, 'leaveRqtState', 'Revoke')
            try:
                db.execute(statement, params=key)
                db.add(db_leaveRq)
                db.commit()
            except SQLAlchemyError as e:
                db.rollback()
                error = str(e.__dict__['orig'])
                return makeJSONInsertResponse("failed",
                                              "Unable to revoke leave",
                                              "reason", error)
            else:
                db.refresh(db_leaveRq)
                return makeJSONInsertResponse("passed",
                                              "Leave request revoked",
                                              "reqId", reqId)
