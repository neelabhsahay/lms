from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import leaveRequestClass


router = APIRouter(
    prefix="/lvrq",
    tags=["lvrq"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createLvrqApp(lvRqst: leaveRequestClass.LeaveRequestCreate,
                  db: Session = Depends(get_db)):
    return leaveRequestClass.insertLeaveRequest(db, lvRqst=lvRqst)


@router.put("/update/{reqId}")
def updateLvrqApp(reqId: int):
    return "Welcome!"


@router.put("/approve/{reqId}")
def approveLvrqApp(reqId: int, db: Session = Depends(get_db)):
    leavesRq = leaveRequestClass.getLeaveRequest(db, reqId=reqId)
    if leavesRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return "Welcome!"


@router.put("/revoke/{reqId}")
def revokeLvrqApp(reqId: int, db: Session = Depends(get_db)):
    leavesRq = leaveRequestClass.getLeaveRequest(db, reqId=reqId)
    if leavesRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return "Welcome!"


@router.get("/get/emp/{empId}",
            response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveForApproveApp(empId: str, skip: int = 0, limit: int = 100,
                          db: Session = Depends(get_db)):
    leavesRq = leaveRequestClass.getLeaveForEmployee(db, empId=empId,
                                                     skip=skip, limit=limit)
    return leavesRq


@router.get("/get/approver/{approver}",
            response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveForApproveApp(approver: str, skip: int = 0, limit: int = 100,
                          db: Session = Depends(get_db)):
    leavesRq = leaveRequestClass.getLeaveForApprove(db, approver=approver,
                                                    skip=skip, limit=limit)
    return leavesRq


@router.get("/get/", response_model=leaveRequestClass.LeaveRequestOut)
def getLeavesRequestsApp(skip: int = 0, limit: int = 100,
                         db: Session = Depends(get_db)):
    leavesRq = leaveRequestClass.getLeaveRequests(db, skip=skip, limit=limit)
    return leavesRq


@router.get("/get/{reqId}", response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveRequestApp(reqId: int, db: Session = Depends(get_db)):
    leavesRq = leaveRequestClass.getLeaveRequest(db, reqId=reqId)
    if leavesRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return leavesRq
