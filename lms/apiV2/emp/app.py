import os
import base64
import shutil
from fastapi import APIRouter, Depends, HTTPException, File, UploadFile
from fastapi.responses import FileResponse
from sqlalchemy.orm import Session
from typing import Optional, List
from pathlib import Path
from config.db import get_db
from auth.auth_handler import security, getCurrentEmpId, decodeJWT, \
authAdmin
from . import empClass

path = "avatar"

router = APIRouter(
    prefix="/emp",
    tags=["emp"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/family/create/")
def createEmpFamilyApp(empFamily: empClass.EmployeeFamilyCreate,
                       db: Session = Depends(get_db),
                       token: str = Depends(authAdmin)):
    return empClass.insertEmpFamily(db=db, empFamily=empFamily)


@router.put("/family/update/{familyId}")
def updateEmpApp(familyId: int, empFamily: empClass.EmployeeFamilyUpdate,
                 db: Session = Depends(get_db),
                 token: str = Depends(authAdmin)):
    existing_empFamily = empClass.getEmpFamilyDb(db, familyId=familyId)
    if existing_empFamily is None:
        raise HTTPException(status_code=404, detail="Emp family not found")
    return empClass.updateEmpFamily(db, db_emp=existing_empFamily,
                                    updates=empFamily)


@router.get("/family/get/", response_model=empClass.EmployeeFamilyOut)
def getEmpsApp(skip: int = 0, getCount: bool = False, limit: int = 100,
               db: Session = Depends(get_db),
               token: str = Depends(decodeJWT)):
    return empClass.getEmpFamilys(db, getCount=getCount, skip=skip, limit=limit)


@router.get("/family/get/{familyId}",
            response_model=empClass.EmployeeFamilyOut)
def getEmpApp(familyId: int, db: Session = Depends(get_db),
              token: str = Depends(decodeJWT)):
    db_empfamily = empClass.getEmpFamily(db, familyId=familyId)
    if db_empfamily is None:
        raise HTTPException(status_code=404, detail="Emp family not found")
    return db_empfamily


@router.post("/create/")
def createEmpApp(employee: empClass.EmployeeCreate,
                 db: Session = Depends(get_db),
                 token: str = Depends(authAdmin)):
    return empClass.insertEmp(db=db, employee=employee)


@router.put("/update/{empId}")
def updateEmpApp(empId: str, employee: empClass.EmployeeUpdate,
                 db: Session = Depends(get_db),
                 token: str = Depends(authAdmin)):
    existing_emp = empClass.getEmpDb(db, empId=empId)
    if existing_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return empClass.updateEmp(db, db_emp=existing_emp, updates=employee)


@router.get("/get/", response_model=empClass.EmployeeOut)
def getEmpsApp(skip: int = 0, getCount: bool = False, limit: int = 100,
               db: Session = Depends(get_db),
               token: str = Depends(decodeJWT)):
    return empClass.getEmps(db, getCount=getCount, skip=skip, limit=limit)


@router.get("/get/{empId}", response_model=empClass.EmployeeOut)
def getEmpApp(empId: str, db: Session = Depends(get_db),
              token: str = Depends(decodeJWT)):
    db_emp = empClass.getEmp(db, empId=empId)
    if db_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return db_emp


@router.get("/search/{key}", response_model=empClass.EmployeeOut)
def getSearchApp(key: str, getCount: bool = False, skip: int = 0,
                 limit: int = 10, db: Session = Depends(get_db),
                 token: str = Depends(decodeJWT)):
    return empClass.search(db, key=key, getCount=getCount,
                           skip=skip, limit=limit)


@router.get("/filter/", response_model=empClass.EmployeeOut)
def getFilterhApp(filters: empClass.EmployeeFilter,
                  getCount: bool = False,
                  skip: int = 0,
                  limit: int = 10,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    return empClass.filter(db, filters=filters, getCount=getCount,
                           skip=skip, limit=limit)


@router.get("/active/", response_model=empClass.EmployeeOut)
def getFilterhApp(getCount: bool = False,
                  skip: int = 0,
                  limit: int = 10,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    filters = empClass.EmployeeFilter(empStatus='ACT')
    return empClass.filter(db, filters=filters, getCount=getCount,
                           skip=skip, limit=limit)


@router.get("/archive/", response_model=empClass.EmployeeOut)
def getFilterhApp(getCount: bool = False,
                  skip: int = 0,
                  limit: int = 10,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    filters = empClass.EmployeeFilter(empStatus='INA')
    return empClass.filter(db, filters=filters, getCount=getCount,
                           skip=skip, limit=limit)


@router.get("/me/", response_model=empClass.EmployeeOut)
def getMyInfoApp(empId: str = Depends(getCurrentEmpId),
                 db: Session = Depends(get_db)):
    db_emp = empClass.getEmp(db, empId=empId)
    if db_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return db_emp


@router.post("/image/{empId}")
async def createUploadImage(empId: str, file: UploadFile = File(...),
                            db: Session = Depends(get_db),
                            token: str = Depends(decodeJWT)):
    suffix = Path(file.filename).suffix
    pathToSafe = os.path.join(path, empId + suffix)

    with open(pathToSafe, "wb+") as image:
        shutil.copyfileobj(file.file, image)

    url = str(pathToSafe)
    existing_emp = empClass.getEmpDb(db, empId=empId)
    if existing_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return empClass.updateImage(db, db_emp=existing_emp, url=url)


@router.get("/image/{empId}")
async def getUploadImage(empId: str,
                         db: Session = Depends(get_db),
                         token: str = Depends(decodeJWT)):
    existing_emp = empClass.getEmpDb(db, empId=empId)
    if existing_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    fileName = existing_emp.url
    if os.path.exists(fileName):
        with open(fileName, "rb") as image:
            encoded_string = base64.b64encode(image.read())
            return {'firstName': existing_emp.firstName,
                    'lastName': existing_emp.lastName,
                    'image': encoded_string}
    return {'firstName': existing_emp.firstName,
            'lastName': existing_emp.lastName}


@router.post("/myimage/")
async def createUploadImage(file: UploadFile = File(...),
                            empId: str = Depends(getCurrentEmpId),
                            db: Session = Depends(get_db)):
    suffix = '.png'
    pathToSafe = os.path.join(path, empId + suffix)

    with open(pathToSafe, "wb+") as image:
        shutil.copyfileobj(file.file, image)

    url = str(pathToSafe)
    existing_emp = empClass.getEmpDb(db, empId=empId)
    if existing_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    return empClass.updateImage(db, db_emp=existing_emp, url=url)


@router.get("/myimage/")
async def createUploadImage(empId: str = Depends(getCurrentEmpId),
                            db: Session = Depends(get_db)):
    existing_emp = empClass.getEmpDb(db, empId=empId)
    if existing_emp is None:
        raise HTTPException(status_code=404, detail="Emp not found")
    if existing_emp.url is None:
        raise HTTPException(status_code=404, detail="Image not found")
    fileName = existing_emp.url
    if os.path.exists(fileName):
        with open(fileName, "rb") as image:
            encoded_string = base64.b64encode(image.read())
            return {'firstName': existing_emp.firstName,
                    'lastName': existing_emp.lastName,
                    'image': encoded_string}
    return {'firstName': existing_emp.firstName,
            'lastName': existing_emp.lastName}
