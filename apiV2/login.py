from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
import bcrypt

from config.db import get_db
from auth.auth_handler import signJWT, decodeJWT
from user.userClass import getUserDb, UserDb, UserLogin

router = APIRouter(
    prefix="/login",
    tags=["login"],
    # dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/")
def loginApp(user: UserLogin, db: Session = Depends(get_db)):
    userDb = getUserDb(db, username=user.username)
    if userDb is None:
        raise HTTPException(status_code=404,
                            detail="Username %s not found" % user.username)
    is_password_correct = bcrypt.checkpw(user.password.encode('utf-8'),
                                         userDb.password.encode('utf-8'))
    response = dict()
    if is_password_correct:
        token = signJWT(empId=userDb.empId, username=userDb.username,
                        accountType=userDb.accountType, hrs=5)
        response["message"] = "Successful login."
        response["status"] = "1"
        response["data"] = dict()
        response["data"]["jwt"] = token['access_token']
        response["data"]["accountType"] = userDb.accountType
    else:
        response["message"] = "Login failed."
        response["status"] = "0"
        response["data"] = dict()
        response["data"]["username"] = user.username
        raise HTTPException(status_code=401,
                            detail=response)
    return response
