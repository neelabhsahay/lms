from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import empClass

router = APIRouter(
    prefix="/emp",
    tags=["emp"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createEmpApp(employee: empClass.EmployeeCreate,
                 db: Session = Depends(get_db)):
    return empClass.insertEmp(db=db, employee=employee)


@router.put("/update/{empId}")
def updateEmpApp(empId: str, employee: empClass.EmployeeUpdate,
                 db: Session = Depends(get_db)):
    existing_emp = empClass.getEmp(db, empId=empId)
    if existing_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    res = empClass.updateEmp(db, emp=existing_emp, updates=employee)
    return res


@router.get("/get/", response_model=empClass.EmployeeOut)
def getEmpsApp(skip: int = 0, limit: int = 100, db: Session = Depends(get_db)):
    leaves = empClass.getEmps(db, skip=skip, limit=limit)
    return leaves


@router.get("/get/{empId}", response_model=empClass.EmployeeOut)
def getEmpApp(empId: str, db: Session = Depends(get_db)):
    db_emp = empClass.getEmp(db, empId=empId)
    if db_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return db_emp
