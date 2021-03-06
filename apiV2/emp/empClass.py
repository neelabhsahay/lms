
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


class EmployeeDb(Base):
    __tablename__ = "employees"

    empId = Column(String(30), primary_key=True, index=True)
    email = Column(EmailType)
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
    url = Column(URLType)
    empType = Column(Enum('PRO', 'PER', 'TMP', 'INT', 'CNT'), default='PRO')
    empStatus = Column(Enum('ACT', 'INA'), default='ACT')
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class EmployeeFamilyDb(Base):
    __tablename__ = "employee_family"

    familyId = Column(BigInteger, primary_key=True, index=True)
    empId = Column(String(30), ForeignKey("employees.empId"))
    familyName = Column(String(30))
    relation = Column(String(10))
    nationality = Column(String(50), default='')
    contact = Column(BigInteger)
    dateOfBirth = Column(DateTime)
    bloodGroup = Column(String(10))
    location = Column(String(30))
    gender = Column(Enum('Male', 'Female', 'Third'), default='Female')
    modifiedOn = Column(DateTime, onupdate=datetime.now)


class Gender(str, PyEnum):
    Male = 'Male'
    Female = 'Female'
    Third = 'Third'


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


class EmployeeFilter(BaseModel):
    empType: Optional[EmpType] = None
    empStatus: Optional[EmpStatus] = None
    departmentId: Optional[str] = None
    manager: Optional[str] = None
    division: Optional[str] = None
    costCenter: Optional[str] = None
    empRole: Optional[str] = None
    location: Optional[str] = None


class EmployeeFamilyBase(BaseModel):
    empId: str
    familyName: str
    relation: str
    nationality: str
    contact: int
    dateOfBirth: date
    bloodGroup: Optional[str] = None
    location: Optional[str] = None
    gender: Optional[Gender] = None
    modifiedOn: Optional[datetime] = None


class EmployeeFamilyCreate(EmployeeFamilyBase):
    pass


class EmployeeFamilyUpdate(EmployeeFamilyBase):
    familyId: int

    class Config:
        orm_mode = True


class EmployeeFamily(EmployeeFamilyBase):
    familyId: int

    class Config:
        orm_mode = True
        use_enum_values = True


class EmployeeFamilyOut(BaseModel):
    body: List[EmployeeFamily] = []
    itemCount: int
    totalCount: int


def search(db: Session, key: str, getCount: bool = False,
           skip: int = 0, limit: int = 10):
    look_for = '{}%'.format(key)
    query = db.query(EmployeeDb).filter(or_(EmployeeDb.firstName.ilike(
        look_for), EmployeeDb.lastName.ilike(
        look_for))).offset(skip).limit(limit)
    emps = query.all()
    count = query.count()
    return makeJSONGetResponse(emps, count)


def getEmpDb(db: Session, empId: str):
    return db.query(EmployeeDb).filter(EmployeeDb.empId == empId).first()


def getEmp(db: Session, empId: str):
    emp = getEmpDb(db, empId=empId)
    if emp is None:
        return None
    else:
        return makeJSONGetResponse(emp, 1)


def getEmps(db: Session, getCount: bool = False,
            skip: int = 0, limit: int = 100):
    emps = db.query(EmployeeDb).offset(skip).limit(limit).all()

    # query = db.query(EmployeeDb, func.count(EmployeeDb.empId).over().label('total'))
    # query = query.order_by(EmployeeDb.empId.asc())
    # query = query.offset(skip)
    # query = query.limit(limit)
    if getCount:
        count = db.query(EmployeeDb).count()
    else:
        count = 0

    return makeJSONGetResponse(emps, count)


def filter(db: Session, filters: EmployeeFilter,
           getCount: bool = False,
           skip: int = 0, limit: int = 100):
    query = db.query(EmployeeDb)
    for attr, value in filters.dict(exclude_unset=True).items():
        query = query.filter(getattr(EmployeeDb, attr) == value)
    queryCount = query
    if getCount:
        count = queryCount.count()
    else:
        count = 1
    emps = query.offset(skip).limit(limit).all()
    return makeJSONGetResponse(emps, count)


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
                                      "reason", error)
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
                                      "reason", error)
    else:
        db.refresh(db_emp)
        return makeJSONInsertResponse("passed",
                                      "Employee record was inserted.",
                                      "empId", db_emp.empId)


def updateImage(db: Session, db_emp: EmployeeDb, url: str):
    setattr(db_emp, 'url', url)
    try:
        db.add(db_emp)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to upload image",
                                      "reason", error)
    else:
        db.refresh(db_emp)
        return makeJSONInsertResponse("passed",
                                      "Employee image was uploaded.",
                                      "empId", db_emp.empId)


def deleteEmp(db: Session, empId: str):
    affected_rows = db.query(EmployeeDb).filter(
        EmployeeDb.empId == empId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Employee record was deleted.",
                                  "empId", empId)


def getEmpFamilyDb(db: Session, familyId: int):
    return db.query(EmployeeFamilyDb).filter(
        EmployeeFamilyDb.familyId == familyId).first()


def getEmpFamily(db: Session, familyId: int):
    empFamily = getEmpDb(db, familyId=familyId)
    if empFamily is None:
        return None
    else:
        return makeJSONGetResponse(empFamily, 1)


def getEmps(db: Session, getCount: bool = False,
            skip: int = 0, limit: int = 100):
    empFamilies = db.query(EmployeeFamilyDb).offset(skip).limit(limit).all()

    if getCount:
        count = db.query(EmployeeFamilyDb).count()
    else:
        count = 0

    return makeJSONGetResponse(empFamilies, count)


def insertEmpFamily(db: Session, empFamily: EmployeeFamilyCreate):
    db_empFamily = EmployeeFamilyDb(**empFamily.dict(exclude_unset=True))
    try:
        db.add(db_empFamily)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed",
                                      "Unable to insert Employee family",
                                      "reason", error)
    else:
        db.refresh(db_empFamily)
        return makeJSONInsertResponse("passed",
                                      "Employee family record was inserted.",
                                      "familyId", db_empFamily.familyId)


def updateEmpFamily(db: Session, db_empFamily: EmployeeFamilyDb,
                    updates: EmployeeFamilyUpdate):
    # Update model class variable from requested fields
    for var, value in vars(updates).items():
        setattr(db_empFamily, var, value) if value else None
    try:
        db.add(db_empFamily)
        db.commit()
    except SQLAlchemyError as e:
        db.rollback()
        error = str(e.__dict__['orig'])
        return makeJSONInsertResponse("failed", "Unable to insert Employee",
                                      "reason", error)
    else:
        db.refresh(db_empFamily)
        return makeJSONInsertResponse("passed",
                                      "Employee record was inserted.",
                                      "familyId", db_empFamily.familyId)


def deleteEmpFamily(db: Session, familyId: int):
    affected_rows = db.query(EmployeeFamilyDb).filter(
        EmployeeFamilyDb.familyId == familyId).delete()
    if not affected_rows:
        raise exc.NoResultFound
    return makeJSONInsertResponse("passed",
                                  "Employee Family record was deleted.",
                                  "familyId", familyId)
