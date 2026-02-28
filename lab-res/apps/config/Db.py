#!/usr/bin/python3
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from sqlalchemy.engine.url import URL
from sqlalchemy.ext.declarative import declarative_base
from fastapi import Depends


# Database configuration
DB_CONFIG = {
    'drivername': 'mysql+pymysql',
    "username": "amd",
    "password": "Amd@123",
    "host": "localhost",
    "database": "lab_resource_schema",
}

engine = create_engine(URL.create(**DB_CONFIG))
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

Base = declarative_base()

# Dependency
def get_db():
    db = SessionLocal()
    try:
    	yield db
    finally:
     db.close()
