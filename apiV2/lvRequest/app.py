from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import leaveRequestClass
from auth.auth_handler import security, decodeJWT, getCurrentEmpId

router = APIRouter(
    prefix="/lvrq",
    tags=["lvrq"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createLvrqApp(lvRqst: leaveRequestClass.LeaveRequestCreate,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    return leaveRequestClass.insertLeaveRequest(db, lvRqst=lvRqst)


@router.put("/update/{reqId}")
def updateLvrqApp(reqId: int,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    return "Welcome!"


@router.put("/approve/")
def approveLvrqApp(lvRqst: leaveRequestClass.LeaveRequestApprove,
                   db: Session = Depends(get_db),
                   token: str = Depends(decodeJWT)):
    leavesRq = leaveRequestClass.approveLeaveRequest(db, lvRqst=lvRqst)
    if leavesRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return leavesRq


@router.put("/revoke/{reqId}")
def revokeLvrqApp(reqId: int, db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    leaveRq = leaveRequestClass.revokeLeaveReqest(db, reqId=reqId)
    if leaveRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return leaveRq


@router.get("/get/emp/{empId}",
            response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveFromEmpApp(empId: str, getCount: bool = False, skip: int = 0,
                       limit: int = 100, db: Session = Depends(get_db),
                       token: str = Depends(decodeJWT)):
    leavesRq = leaveRequestClass.getLeaveFromEmployee(db, empId=empId,
                                                      getCount=getCount,
                                                      skip=skip, limit=limit)
    return leavesRq


@router.get("/get/approver/{approver}",
            response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveForApproveApp(approver: str, getCount: bool = False, skip: int = 0,
                          limit: int = 100,
                          db: Session = Depends(get_db),
                          token: str = Depends(decodeJWT)):
    leavesRq = leaveRequestClass.getLeaveForApprove(db, approver=approver,
                                                    getCount=getCount,
                                                    skip=skip, limit=limit)
    return leavesRq


@router.get("/get/", response_model=leaveRequestClass.LeaveRequestOut)
def getLeavesRequestsApp(getCount: bool = False, skip: int = 0,
                         limit: int = 100,
                         db: Session = Depends(get_db),
                         token: str = Depends(decodeJWT)):
    leavesRq = leaveRequestClass.getLeaveRequests(db, getCount=getCount,
                                                  skip=skip, limit=limit)
    return leavesRq


@router.post("/filter/", response_model=leaveRequestClass.LeaveRequestOut)
def getLeavesRequestsFilteredApp(filters: leaveRequestClass.LeaveRequestFilter,
                                 getCount: bool = False, skip: int = 0,
                                 limit: int = 100,
                                 db: Session = Depends(get_db),
                                 token: str = Depends(decodeJWT)):
    leavesRq = leaveRequestClass.getLeaveRequestsFilter(db, filters=filters,
                                                        getCount=getCount,
                                                        skip=skip, limit=limit)
    return leavesRq

@router.get("/get/{reqId}", response_model=leaveRequestClass.LeaveRequestOut)
def getLeaveRequestApp(reqId: int, db: Session = Depends(get_db),
                       token: str = Depends(decodeJWT)):
    leavesRq = leaveRequestClass.getLeaveRequest(db, reqId=reqId)
    if leavesRq is None:
        raise HTTPException(status_code=404, detail="leave request not found")
    return leavesRq


@router.get("/me/", response_model=leaveRequestClass.LeaveRequestOut)
def getMyLeaveRequestApp(empId: str = Depends(getCurrentEmpId),
                         getCount: bool = False, skip: int = 0, limit: int = 100,
                         db: Session = Depends(get_db)):
    return leaveRequestClass.getLeaveFromEmployee(db, empId=empId,
                                                  getCount=getCount,
                                                  skip=skip, limit=limit)


@router.post("/meapprove/", response_model=leaveRequestClass.LeaveRequestOut)
def getMyApproveLeaveRequestApp(filters: leaveRequestClass.LeaveRequestFilter,
                                empId: str = Depends(getCurrentEmpId),
                                getCount: bool = False, skip: int = 0,
                                limit: int = 100,
                                db: Session = Depends(get_db)):
    return leaveRequestClass.getLeaveForApprove(db, approver=empId,
                                                filters=filters,
                                                getCount=getCount,
                                                skip=skip, limit=limit)


@router.post("/range/", response_model=leaveRequestClass.LeaveRequestOut)
def getMyApproveLeaveRequestApp(rangeDt: leaveRequestClass.LeaveRequestRange,
                                empId: str = Depends(getCurrentEmpId),
                                skip: int = 0, limit: int = 100,
                                db: Session = Depends(get_db)):
    return leaveRequestClass.getMyLeaveRqInRange(db, empId=empId,
                                                 rangeDt=rangeDt,
                                                 skip=skip, limit=limit)
