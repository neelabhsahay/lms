import time
from typing import Dict
from fastapi import HTTPException, status, Security
from fastapi.security import HTTPAuthorizationCredentials
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


def decodeJWT(Credentials: HTTPAuthorizationCredentials = Security(security)
              ) -> dict:
    credentials_exception = {
        "status_code": status.HTTP_401_UNAUTHORIZED,
        "detail": "Could not validate credentials",
        "headers": {"WWW-Authenticate": "Bearer"},
    }
    expired_exception = {
        "status_code": status.HTTP_403_FORBIDDEN,
        "detail": "Access denied. Token Expired.",
        "headers": {"WWW-Authenticate": "Bearer"},
    }
    token = Credentials.credentials
    try:
        decoded_token = jwt.decode(token, JWT_SECRET,
                                   algorithms=[JWT_ALGORITHM])
    except jwt.ExpiredSignatureError:
        credentials_exception["detail"] = "Expire Signature Error"
        raise HTTPException(**credentials_exception)
    except jwt.DecodeError:
        credentials_exception["detail"] = "Decode Error"
        raise HTTPException(**credentials_exception)
    except jwt.InvalidSignatureError:
        credentials_exception["detail"] = "Invalid Signature Error"
        raise HTTPException(**credentials_exception)
    except jwt.InvalidTokenError:
        credentials_exception["detail"] = "Invalid Token Error"
        raise HTTPException(**credentials_exception)
    else:
        return decoded_token


def authAdmin(Credentials: HTTPAuthorizationCredentials = Security(security)
              ):
    expired_exception = {
        "status_code": status.HTTP_403_FORBIDDEN,
        "detail": "Access denied.",
        "headers": {"WWW-Authenticate": "Bearer"},
    }
    decoded_token = decodeJWT(Credentials)
    if decoded_token['accountType'] != 'ADM':
        raise HTTPException(**expired_exception)


def getCurrentEmpId(Credentials: HTTPAuthorizationCredentials = Security(security)):
    credentials_exception = {
        "status_code": status.HTTP_401_UNAUTHORIZED,
        "detail": "Could not validate credentials",
        "headers": {"WWW-Authenticate": "Bearer"},
    }
    expired_exception = {
        "status_code": status.HTTP_403_FORBIDDEN,
        "detail": "Access denied. Token Expired.",
        "headers": {"WWW-Authenticate": "Bearer"},
    }
    token = Credentials.credentials
    try:
        payload = jwt.decode(token, JWT_SECRET, algorithms=[JWT_ALGORITHM])
        empId: str = payload.get("empId")
        username: str = payload.get("username")
        if payload["expires"] < time.time():
            raise HTTPException(**expired_exception)
        if empId is None or username is None:
            raise HTTPException(**credentials_exception)
    except jwt.ExpiredSignatureError:
        credentials_exception["detail"] = "Expire Signature Error"
        raise HTTPException(**credentials_exception)
    except jwt.DecodeError:
        credentials_exception["detail"] = "Decode Error"
        raise HTTPException(**credentials_exception)
    except jwt.InvalidSignatureError:
        credentials_exception["detail"] = "Invalid Signature Error"
        raise HTTPException(**credentials_exception)
    except jwt.InvalidTokenError:
        credentials_exception["detail"] = "Invalid Token Error"
        raise HTTPException(**credentials_exception)
    else:
        return empId
