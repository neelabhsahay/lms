
from sqlalchemy import Boolean, Column, ForeignKey, BigInteger, String, Enum, \
 DateTime
from sqlalchemy.exc import SQLAlchemyError
from sqlalchemy.orm import relationship, Session
from pydantic import BaseModel
from typing import Optional, List
from datetime import datetime, date
from enum import Enum as PyEnum

from config.db import Base
from libs.utils import makeJSONGetResponse


class EmployeeDb(Base):
    __tablename__ = "employees"

    empId = Column(String(30), primary_key=True, index=True)
    email = Column(String(40))
    firstName = Column(String(50))
    middleName = Column(String(50), default='')
    lastName = Column(String(50), default='')
    manager = Column(String(30), ForeignKey("employees.empId"))
    departmentId = Column(String(30), default='SW')
    division = Column(String(30), default='SW')
    grade = Column(String(30))
    topLevel = Column(String(30))
    costCenter = Column(String(40))
    contact = Column(BigInteger)
    dateOfBirth = Column(DateTime)
    dateOfJoin = Column(DateTime)
    location = Column(String(50))
    empRole = Column(String(40))
    empType = Column(Enum('PRO', 'PER', 'TMP', 'INT', 'CNT'), default='PRO')
    empStatus = Column(Enum('ACT', 'INA'), default='ACT')
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class EmpType(str, PyEnum):
    PRO = 'PRO'
    PER = 'PER'
    TMP = 'TMP'
    INR = 'INT'
    CNT = 'CNT'


class EmpStatus(str, PyEnum):
    ACT = 'ACT'
    INA = 'INA'


class EmployeeBase(BaseModel):
    firstName: str
    middleName: Optional[str] = None
    lastName: Optional[str] = None
    email: str
    manager: str
    departmentId: Optional[str] = None
    division: Optional[str] = None
    grade: Optional[str] = None
    topLevel: Optional[str] = None
    costCenter: Optional[str] = None
    contact: int
    dateOfBirth: date
    dateOfJoin: date
    location: str
    empRole: str
    empType: Optional[EmpType] = None
    empStatus: Optional[EmpStatus] = None
    modifiedOn: Optional[datetime] = None


class EmployeeCreate(EmployeeBase):
    pass


class EmployeeUpdate(EmployeeBase):
    empId: str

    class Config:
        orm_mode = True


class Employee(EmployeeBase):
    empId: str

    class Config:
        orm_mode = True
        use_enum_values = True


class EmployeeOut(BaseModel):
    body: List[Employee] = []
    itemCount: int
    totalCount: int


def getEmp(db: Session, empId: str):
    emp = db.query(EmployeeDb).filter(EmployeeDb.empId == empId).first()
    if emp is None:
        return None
    else:
        return makeJSONGetResponse(emp, 1)


def getEmps(db: Session, skip: int = 0, limit: int = 100):
    emps = db.query(EmployeeDb).offset(skip).limit(limit).all()
    return makeJSONGetResponse(emps, 1)


def insertEmp(db: Session, employee: EmployeeCreate):
    empl = db.query(EmployeeDb).order_by(EmployeeDb.empId.desc()).first()
    if empl is None:
        empId = 'EN0001'
    else:
        lastEmpId = empl.empId
        val = lastEmpId.strip('EN')
        empId = 'EN' + ('%04d') % (int(val) + 1)
    employeeDb = EmployeeDb(**employee.dict(exclude_unset=True), empId=empId)
    try:
        db.add(employeeDb)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Employee",
                                      "error", error)
    else:
        db.refresh(employeeDb)
        return makeJSONInsertResponse("passed",
                                      "Employee record was inserted.",
                                      "empId", empId)


def updateEmp(db: Session, db_emp: EmployeeDb, updates: EmployeeUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_emp, var, value) if value else None
    try:
        db.add(db_emp)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Employee",
                                      "error", error)
    else:
        db.refresh(db_emp)
        return makeJSONInsertResponse("passed",
                                      "Employee record was inserted.",
                                      "empId", emp.empId)


def deleteEmp(db: Session, empId: str):
    affected_rows = db.query(EmployeeDb).filter(
        EmployeeDb.empId == empId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Employee record was deleted.",
                                  "empId", empId)