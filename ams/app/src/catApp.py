from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from typing import Optional, List
from config.db import get_db
from . import catClass
from auth.auth_handler import security, decodeJWT

router = APIRouter(
    prefix="/config",
    tags=["category"],
    #dependencies=[Depends(get_token_header)],
    responses={404: {"description": "Not found"}},
)


@router.post("/cat/create/")
def createCategoryApp(category: catClass.CategoryCreate,
                      db: Session = Depends(get_db),
                      token: str = Depends(decodeJWT)):
    return catClass.insertCategory(db=db, category=category)


@router.put("/cat/update/{categoryId}")
def updateCategoryApp(categoryId: int, category: catClass.CategoryUpdate,
                      db: Session = Depends(get_db),
                      token: str = Depends(decodeJWT)):
    existing_cat = catClass.getCategoryDb(db, categoryId=categoryId)
    if existing_cat is None:
        raise HTTPException(status_code=404, detail="category not found")
    res = catClass.updateCategory(db, db_category=existing_cat, updates=category)
    return res


@router.get("/cat/get/", response_model=catClass.CategoryOut)
def getCategoryApp(getCount: bool = False, skip: int = 0, limit: int = 100,
                   db: Session = Depends(get_db),
                   token: str = Depends(decodeJWT)):
    return catClass.getCategorys(db, skip=skip, limit=limit)


@router.get("/cat/get/{categoryId}", response_model=catClass.CategoryOut)
def getCategoryApp(categoryId: int, db: Session = Depends(get_db),
                   token: str = Depends(decodeJWT)):
    db_cat = catClass.getCategory(db, categoryId=categoryId)
    if db_cat is None:
        raise HTTPException(status_code=404, detail="catogary not found")
    return db_cat


@router.post("/subcat/create/")
def createSubCategoryApp(subCategory: catClass.SubCategoryCreate,
                         db: Session = Depends(get_db),
                         token: str = Depends(decodeJWT)):
    return catClass.insertSubCategory(db=db, subCategory=subCategory)


@router.put("/subcat/update/{subCategoryId}")
def updateLeaveApp(subCategoryId: int, subCategory: catClass.SubCategoryUpdate,
                   db: Session = Depends(get_db),
                   token: str = Depends(decodeJWT)):
    existing_subCat = catClass.getCategoryDb(db, subCategoryId=subCategoryId)
    if existing_subCat is None:
        raise HTTPException(status_code=404, detail="sub category not found")
    res = catClass.updateSubCategory(db, db_subCategory=existing_subCat,
                                     updates=subCategory)
    return res


@router.get("/subcat/get/", response_model=catClass.CategoryOut)
def getSubCategoryApp(getCount: bool = False, skip: int = 0, limit: int = 100,
                      db: Session = Depends(get_db),
                      token: str = Depends(decodeJWT)):
    return catClass.getSubCategorys(db, skip=skip, limit=limit)


@router.get("/subcat/get/{categoryId}", response_model=catClass.CategoryOut)
def getSubCategoryApp(subCategoryId: int, db: Session = Depends(get_db),
                      token: str = Depends(decodeJWT)):
    db_subCat = catClass.getSubCategory(db, subCategoryId=subCategoryId)
    if db_subCat is None:
        raise HTTPException(status_code=404, detail="sub catogary not found")
    return db_cat


@router.post("/del/create/")
def createSubCategoryApp(subCategory: catClass.DeliveryCreate,
                         db: Session = Depends(get_db),
                         token: str = Depends(decodeJWT)):
    return catClass.insertDelivery(db=db, delivery=delivery)


@router.put("/del/update/{deliveryId}")
def updateLeaveApp(deliveryId: int, delivery: catClass.DeliveryUpdate,
                   db: Session = Depends(get_db),
                   token: str = Depends(decodeJWT)):
    existing_del = catClass.getDeliveryDb(db, deliveryId=deliveryId)
    if existing_del is None:
        raise HTTPException(status_code=404, detail="sub category not found")
    res = catClass.updateDelivery(db, db_subCategory=existing_delt,
                                  updates=delivery)
    return res


@router.get("/del/get/", response_model=catClass.DeliveryOut)
def getDeliverysApp(getCount: bool = False, skip: int = 0, limit: int = 100,
                    db: Session = Depends(get_db),
                    token: str = Depends(decodeJWT)):
    return catClass.getDeliverys(db, skip=skip, limit=limit)


@router.get("/del/get/{categoryId}", response_model=catClass.DeliveryOut)
def getDeliveryApp(subCategoryId: int, db: Session = Depends(get_db),
                   token: str = Depends(decodeJWT)):
    db_delivery = catClass.getDelivery(db, deliveryId=deliveryId)
    if db_delivery is None:
        raise HTTPException(status_code=404, detail="Delivery not found")
    return db_cat
