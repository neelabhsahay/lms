from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import leaveStatusClass
from auth.auth_handler import security, decodeJWT, getCurrentEmpId

router = APIRouter(
    prefix="/lvst",
    tags=["lvst"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createLeavesStatusApp(lvst: leaveStatusClass.LeaveStatusCreate,
                          db: Session = Depends(get_db),
                          token: str = Depends(decodeJWT)):
    return leaveStatusClass.insertLeaveStatus(db=db, lvst=lvst)


@router.put("/update/")
def updateLeavesStatusApp(lvst: leaveStatusClass.LeaveStatusUpdate,
                          db: Session = Depends(get_db),
                          token: str = Depends(decodeJWT)):
    key = leaveStatusClass.LeaveStatusKey(leaveId=lvst.leaveId,
                                          empId=lvst.empId,
                                          year=lvst.year)
    db_leaveSt = leaveStatusClass.getLeaveStatusDb(db, key)
    if db_leaveSt is None:
        raise HTTPException(status_code=404, detail="Leave Status not found")
    return leaveStatusClass.updateLeaveStatus(db, leave=db_leaveSt,
                                              updates=lvst)


@router.get("/search/{key}", response_model=leaveStatusClass.LeaveStatusOut)
def getSearchApp(key: str, getCount: bool = False,
                 skip: int = 0, limit: int = 10,
                 db: Session = Depends(get_db),
                 token: str = Depends(decodeJWT)):
    return leaveStatusClass.search(db, key=key, getCount=getCount,
                                   skip=skip, limit=limit)


@router.get("/get/", response_model=leaveStatusClass.LeaveStatusOut)
def getLeavesStatusApp(key: Optional[leaveStatusClass.LeaveStatusKey] = None,
                       getCount: bool = False, skip: int = 0, limit: int = 100,
                       db: Session = Depends(get_db),
                       token: str = Depends(decodeJWT)):
    if key is None:
        db_leavesSt = leaveStatusClass.getLeavesStatus(db, getCount=getCount,
                                                       skip=skip,
                                                       limit=limit)
    else:
        db_leavesSt = leaveStatusClass.getLeaveStatus(db, key=key)
        if db_leavesSt is None:
            raise HTTPException(status_code=404,
                                detail="leave status not found")
    return db_leavesSt


@router.get("/me/", response_model=leaveStatusClass.LeaveStatusOut)
def getMyLeaveStatuApp(empId: str = Depends(getCurrentEmpId),
                       getCount: bool = False, skip: int = 0, limit: int = 100,
                       db: Session = Depends(get_db)):
    return leaveStatusClass.getEmpLeaveStatus(db, empId=empId)
