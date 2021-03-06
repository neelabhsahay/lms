from typing import Optional, List
from pydantic import BaseModel, Field
from datetime import datetime, date
from sqlalchemy import Column, ForeignKey, Integer, String, DateTime, Float, \
or_
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session, subqueryload
from sqlalchemy.sql import text

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


def getLeaveStatusDb(db: Session, key: LeaveStatusKey):
    return db.query(LeaveStatusDb).filter(
                    LeaveStatusDb.leaveId == key.leaveId,
                    LeaveStatusDb.empId == key.empId,
                    LeaveStatusDb.year == key.year).first()


def getLeaveStatus(db: Session, key: LeaveStatusKey):
    leaveSt = getLeaveStatusDb(db, key=key)
    if leaveSt is None:
        return None
    else:
        return makeJSONGetResponse(getLeaveStatusResponse(leaveSt), 1)


def search(db: Session, key: str, getCount: bool = False,
           skip: int = 0, limit: int = 10):
    look_for = '%{}%'.format(key)
    leavesSt = db.query(LeaveStatusDb).filter(
        LeaveStatusDb.empId.ilike(look_for)).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(LeaveStatusDb).filter(
            LeaveStatusDb.empId.ilike(look_for)).count()
    else:
        count = 0
    return makeJSONGetResponse(getLeaveStatusResponse(leavesSt), count)


def getLeavesStatus(db: Session, getCount: bool = False,
                    skip: int = 0, limit: int = 100):
    #query = db.query(LeaveStatusDb).join(LeaveStatusDb.employee).options(
    #     subqueryload(LeaveStatusDb.employee)).filter(EmployeeDb.empStatus == 'ACT')
    query = db.query(LeaveStatusDb)
    queryCount = query
    if getCount:
        count = queryCount.count()
    else:
        count = 0
    leavesSt = query.order_by(LeaveStatusDb.empId).offset(skip).limit(limit).all()
    return makeJSONGetResponse(getLeaveStatusResponse(leavesSt), count)


def getEmpLeaveStatus(db: Session, empId: str,
                      getCount: bool = False,
                      skip: int = 0, limit: int = 100):
    leavesSt = db.query(LeaveStatusDb).filter(
        LeaveStatusDb.empId == empId).offset(skip).limit(limit).all()
    if getCount:
        count = db.query(LeaveStatusDb).filter(
          LeaveStatusDb.empId == empId).count()
    else:
        count = 0
    return makeJSONGetResponse(getLeaveStatusResponse(leavesSt), count)


def insertLeaveStatus(db: Session, leaveStatus: LeaveStatusCreate):
    leaveStatusDb = LeaveStatusDb(**leaveStatus.dict(exclude_unset=True))
    try:
        db.add(leaveStatusDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert leavestatus",
                                      "reason", error)
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
                                      "reason", error)
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


def insertYearlyLeave(db: Session, year: int, empId: str):
    key = {
           "empId": empId,
           "year": year
           }
    statement = text("""INSERT INTO emp_leaves_status
                        (empId, leaveId, year, leaveInYear, modifiedBy )
                         SELECT employees.empId, leaves.leaveId, :year,
                         leaves.leaveMax, :empId from employees, leaves
                          WHERE employees.empStatus = 'ACT'""")
    try:
        db.execute(statement, params=key)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert leavestatus",
                                      "reason", error)
    else:
        return makeJSONInsertResponse("passed",
                                      "Leave Status record was inserted.",
                                      ["year", 'empId'],
                                      [year, empId])
