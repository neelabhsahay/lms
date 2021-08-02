from fastapi import APIRouter, Depends, HTTPException, Security
from fastapi.security import HTTPAuthorizationCredentials
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import leaveRequestClass
from auth.auth_handler import security

router = APIRouter(
    prefix="/lvrq",
    tags=["lvrq"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createLvrqApp(lvRqst: leaveRequestClass.LeaveRequestCreate,
                  db: Session = Depends(get_db),
                  token: HTTPAuthorizationCredentials = Security(security)):
    return leaveRequestClass.insertLeaveRequest(db, lvRqst=lvRqst)


@router.put("/update/{reqId}")
def updateLvrqApp(reqId: int,
                  db: Session = Depends(get_db),
                  token: HTTPAuthorizationCredentials = Security(security)):
    return "Welcome!"


@router.put("/approve/")
def approveLvrqApp(lvRqst: leaveRequestClass.LeaveRequestApprove,
                   db: Session = Depends(get_db),
                   token: HTTPAuthorizationCredentials = Security(security)):
    leavesRq = leaveRequestClass.approveLeaveRequest(db, lvRqst=lvRqst)
    if leavesRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return leavesRq


@router.put("/revoke/{reqId}")
def revokeLvrqApp(reqId: int, db: Session = Depends(get_db),
                  token: HTTPAuthorizationCredentials = Security(security)):
    leaveRq = leaveRequestClass.revokeLeaveReqest(db, reqId=reqId)
    if leaveRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return leaveRq


@router.get("/get/emp/{empId}",
            response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveFromEmpApp(empId: str, getCount: bool = False, skip: int = 0,
                       limit: int = 100, db: Session = Depends(get_db),
                       token: HTTPAuthorizationCredentials = Security(security)):
    leavesRq = leaveRequestClass.getLeaveFromEmployee(db, empId=empId,
                                                      getCount=getCount,
                                                      skip=skip, limit=limit)
    return leavesRq


@router.get("/get/approver/{approver}",
            response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveForApproveApp(approver: str, getCount: bool = False, skip: int = 0,
                          limit: int = 100,
                          db: Session = Depends(get_db),
                          token: HTTPAuthorizationCredentials = Security(security)):
    leavesRq = leaveRequestClass.getLeaveForApprove(db, approver=approver,
                                                    getCount=getCount,
                                                    skip=skip, limit=limit)
    return leavesRq


@router.get("/get/", response_model=leaveRequestClass.LeaveRequestOut)
def getLeavesRequestsApp(getCount: bool = False, skip: int = 0,
                         limit: int = 100,
                         db: Session = Depends(get_db),
                         token: HTTPAuthorizationCredentials = Security(security)):
    leavesRq = leaveRequestClass.getLeaveRequests(db, getCount=getCount,
                                                  skip=skip, limit=limit)
    return leavesRq


@router.get("/get/{reqId}", response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveRequestApp(reqId: int, db: Session = Depends(get_db),
                       token: HTTPAuthorizationCredentials = Security(security)):
    leavesRq = leaveRequestClass.getLeaveRequest(db, reqId=reqId)
    if leavesRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return leavesRq
