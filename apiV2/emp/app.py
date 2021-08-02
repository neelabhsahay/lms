from fastapi import APIRouter, Depends, HTTPException, Security
from fastapi.security import HTTPAuthorizationCredentials
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from auth.auth_handler import security
from . import empClass

router = APIRouter(
    prefix="/emp",
    tags=["emp"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createEmpApp(employee: empClass.EmployeeCreate,
                 db: Session = Depends(get_db),
                 token: HTTPAuthorizationCredentials = Security(security)):
    return empClass.insertEmp(db=db, employee=employee)


@router.put("/update/{empId}")
def updateEmpApp(empId: str, employee: empClass.EmployeeUpdate,
                 db: Session = Depends(get_db),
                 token: HTTPAuthorizationCredentials = Security(security)):
    existing_emp = empClass.getEmpDb(db, empId=empId)
    if existing_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return empClass.updateEmp(db, db_emp=existing_emp, updates=employee)


@router.get("/get/", response_model=empClass.EmployeeOut)
def getEmpsApp(skip: int = 0, getCount: bool = False, limit: int = 100,
               db: Session = Depends(get_db),
               token: HTTPAuthorizationCredentials = Security(security)):
    return empClass.getEmps(db, getCount=getCount, skip=skip, limit=limit)


@router.get("/get/{empId}", response_model=empClass.EmployeeOut)
def getEmpApp(empId: str, db: Session = Depends(get_db),
              token: HTTPAuthorizationCredentials = Security(security)):
    db_emp = empClass.getEmp(db, empId=empId)
    if db_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return db_emp


@router.get("/search/{key}", response_model=empClass.EmployeeOut)
def getSearchApp(key: str, getCount: bool = False, skip: int = 0,
                 limit: int = 10, db: Session = Depends(get_db),
                 token: HTTPAuthorizationCredentials = Security(security)):
    return empClass.search(db, key=key, getCount=getCount,
                           skip=skip, limit=limit)


@router.get("/me/", response_model=empClass.EmployeeOut)
def getMyInfoApp(empId: str, db: Session = Depends(get_db),
                 token: HTTPAuthorizationCredentials = Security(security)):
    db_emp = empClass.getEmp(db, empId=empId)
    if db_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return db_emp
