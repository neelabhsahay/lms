from fastapi import APIRouter, Depends, HTTPException
from fastapi.security import OAuth2PasswordRequestForm
from sqlalchemy.orm import Session
import bcrypt

from config.db import get_db
from auth.auth_handler import signJWT, decodeJWT, oauth2_scheme
from pydantic import BaseModel
# from user.userClass import getUserDb, UserDb, UserLogin

router = APIRouter(
    prefix="/login",
    tags=["login"],
    # dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


class UserLogin(BaseModel):
    username: str
    password: str


@router.post("/")
def loginApp(user: OAuth2PasswordRequestForm = Depends(),
             db: Session = Depends(get_db)):
    # userDb = getUserDb(db, username=user.username)
    # if userDb is None:
    #    raise HTTPException(status_code=404,
    #                        detail="Username %s not found" % user.username)
    # is_password_correct = bcrypt.checkpw(user.password.encode('utf-8'),
    #
    #                                      userDb.password.encode('utf-8'))
    is_password_correct = True
    empId = 'EN0002'
    username = 'nsahay'
    accountType = 'ADM'
    response = dict()
    if is_password_correct:
        token = signJWT(empId=empId, username=username,
                        accountType=accountType, hrs=5)
        response["message"] = "Successful login."
        response["status"] = "1"
        response["data"] = dict()
        response["data"]["jwt"] = token['access_token']
        #response["data"]["accountType"] = userDb.accountType
        response["data"]["accountType"] = accountType
    else:
        response["message"] = "Login failed."
        response["status"] = "0"
        response["data"] = dict()
        #response["data"]["username"] = user.username
        response["data"]["username"] = username
        raise HTTPException(status_code=401,
                            detail=response)
    return response
