from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import userClass
from auth.auth_handler import security, decodeJWT


router = APIRouter(
    prefix="/user",
    tags=["user"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/create/")
def createUserApp(user: userClass.UserCreate,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    existing_user = userClass.getUserDb(db, username=user.username)
    if existing_user is not None:
        raise HTTPException(status_code=403, detail="Username already exist.")
    return userClass.insertUser(db, user=user)


@router.put("/update/{username}")
def updateUserApp(username: str, user: userClass.UserUpdate,
                  db: Session = Depends(get_db),
                  token: str = Depends(decodeJWT)):
    existing_user = userClass.getUserDb(db, username=username)
    if existing_user is None:
        raise HTTPException(status_code=404, detail="Username not found")
    return userClass.updateUser(db, db_user=existing_user, updates=user)


@router.get("/get/", response_model=userClass.UserOut)
@router.get("/get/{username}", response_model=userClass.UserOut)
def getUserApp(username: Optional[str] = None, getCount: bool = False,
               skip: int = 0, limit: int = 100,
               db: Session = Depends(get_db),
               token: str = Depends(decodeJWT)):
    if(username is None):
        users = userClass.getUsers(db, getCount=getCount,
                                   skip=skip, limit=limit)
    else:
        users = userClass.getUser(db, username=username)
    return users


@router.get("/me/", response_model=userClass.UserOut)
def getUserApp(username: Optional[str] = None, getCount: bool = False,
               skip: int = 0, limit: int = 100,
               db: Session = Depends(get_db),
               token: str = Depends(decodeJWT)):
    return userClass.getUser(db, username=token['username'])
