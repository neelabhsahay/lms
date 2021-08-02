import time
from typing import Dict
from fastapi import HTTPException, status
import jwt
from decouple import config
from fastapi.security import HTTPBearer


JWT_SECRET = config("secret")
JWT_ALGORITHM = config("algorithm")
JWT_ISSUER = config("issuer")


security = HTTPBearer()


def token_response(token: str):
    return {
        "access_token": token
    }


def signJWT(empId: str, username: str,
            accountType: str, hrs: int) -> Dict[str, str]:
    payload = {
        "iss": JWT_ISSUER,
        "expires": time.time() + (hrs * 60 * 60),
        'iat': time.time(),
        "username": username,
        "empId": empId,
        "accountType": accountType
    }
    token = jwt.encode(payload, JWT_SECRET, algorithm=JWT_ALGORITHM)

    return token_response(token)


def decodeJWT(token: str) -> dict:
    credentials_exception = HTTPException(
        status_code=status.HTTP_401_UNAUTHORIZED,
        detail="Could not validate credentials",
        headers={"WWW-Authenticate": "Bearer"},
    )
    expired_exception = HTTPException(
        status_code=status.HTTP_403_UNAUTHORIZED,
        detail="Access denied. Token Expired.",
        headers={"WWW-Authenticate": "Bearer"},
    )
    try:
        decoded_token = jwt.decode(token, JWT_SECRET,
                                   algorithms=[JWT_ALGORITHM])
    except jwt.ExpiredSignatureError:
        raise expired_exception
    except jwt.DecodeError:
        raise credentials_exception
    except jwt.InvalidSignatureError:
        raise credentials_exception
    except jwt.InvalidTokenError:
        raise credentials_exception
    else:
        return decoded_token


def getCurrentEmpId(token: str):
    credentials_exception = HTTPException(
        status_code=status.HTTP_401_UNAUTHORIZED,
        detail="Could not validate credentials",
        headers={"WWW-Authenticate": "Bearer"},
    )
    expired_exception = HTTPException(
        status_code=status.HTTP_403_UNAUTHORIZED,
        detail="Access denied. Token Expired.",
        headers={"WWW-Authenticate": "Bearer"},
    )
    try:
        payload = jwt.decode(token, JWT_SECRET, algorithms=[ALGORITHM])
        empId: str = payload.get("empId")
        username: str = payload.get("username")
        if decoded_token["expires"] < time.time():
            raise expired_exception
        if empId is None or username is None:
            raise credentials_exception
    except jwt.ExpiredSignatureError:
        raise expired_exception
    except jwt.DecodeError:
        raise credentials_exception
    except jwt.InvalidSignatureError:
        raise credentials_exception
    except jwt.InvalidTokenError:
        raise credentials_exception
    else:
        return empId
