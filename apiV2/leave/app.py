from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import leaveClass

router = APIRouter(
    prefix="/leave",
    tags=["leave"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createLeaveApp(leave: leaveClass.LeaveCreate,
                   db: Session = Depends(get_db)):
    return leaveClass.insertLeave(db=db, leave=leave)


@router.put("/update/{leaveId}")
def updateLeaveApp(leaveId: str, leave: leaveClass.LeaveUpdate,
                   db: Session = Depends(get_db)):
    existing_leave = leaveClass.getLeave(db, leaveId=leaveId)
    if existing_leave is None:
        raise HTTPException(status_code=404, detail="Leave not found")
    res = leaveClass.updateLeave(db, leave=existing_leave, updates=leave)
    return res


@router.get("/get/", response_model=leaveClass.LeaveOut)
def getLeavesApp(skip: int = 0, limit: int = 100,
                 db: Session = Depends(get_db)):
    leaves = leaveClass.getLeaves(db, skip=skip, limit=limit)
    return leaves


@router.get("/get/{leaveId}", response_model=leaveClass.LeaveOut)
def getLeaveApp(leaveId: str, db: Session = Depends(get_db)):
    db_leave = leaveClass.getLeave(db, leaveId=leaveId)
    if db_leave is None:
        raise HTTPException(status_code=404, detail="leave not found")
    return db_leave
