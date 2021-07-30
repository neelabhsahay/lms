from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import userClass


router = APIRouter(
    prefix="/user",
    tags=["user"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createUserApp(user: userClass.UserCreate):
    hashed_password = bcrypt.hashpw(user.password.encode('utf-8'),
                                    bcrypt.gensalt())
    return "Welcome!"


@router.put("/update/{username}")
def updateUserApp(user: userClass.UserCreate):
    return "Welcome!"


@router.get("/get/", response_model=userClass.UserOut)
@router.get("/get/{username}", response_model=userClass.UserOut)
def getUserApp(username: Optional[str] = None, skip: int = 0, limit: int = 100,
               db: Session = Depends(get_db)):
    if(username is None):
        users = userClass.getUsers(db, skip=skip, limit=limit)
    else:
        users = userClass.getUser(db, username=username)
    return users
