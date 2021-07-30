from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import leaveStatusClass

router = APIRouter(
    prefix="/lvst",
    tags=["lvst"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createLeavesStatusApp(lvst: leaveStatusClass.LeaveStatusCreate,
                          db: Session = Depends(get_db)):
    return leaveStatusClass.insertLeaveStatus(db=db, lvst=lvst)


@router.put("/update/")
def updateLeavesStatusApp(lvst: leaveStatusClass.LeaveStatusUpdate,
                          db: Session = Depends(get_db)):
    db_leaveSt = db.query(leaveStatusClass.LeaveStatusDb).filter(
                    leaveStatusClass.LeaveStatusDb.leaveId == lvst.leaveId,
                    leaveStatusClass.LeaveStatusDb.empId == lvst.empId,
                    leaveStatusClass.LeaveStatusDb.year == lvst.year).first()
    if db_leaveSt is None:
        raise HTTPException(status_code=404, detail="Leave Status not found")
    res = leaveStatusClass.updateLeaveStatus(db, leave=db_leaveSt,
                                             updates=lvst)
    return res


@router.get("/get/", response_model=leaveStatusClass.LeaveStatusOut)
def getLeavesStatusApp(key: Optional[leaveStatusClass.LeaveStatusKey] = None,
                       skip: int = 0, limit: int = 100,
                       db: Session = Depends(get_db)):
    if key is None:
        db_leavesSt = leaveStatusClass.getLeavesStatus(db, skip=skip,
                                                       limit=limit)
    else:
        db_leavesSt = leaveStatusClass.getLeaveStatus(db, key=key)
        if db_leavesSt is None:
            raise HTTPException(status_code=404,
                                detail="leave status not found")
    return db_leavesSt
