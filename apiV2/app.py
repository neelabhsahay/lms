import uvicorn

from fastapi import Depends, FastAPI, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from config.db import engine, Base

from user.app import router as userRouter
from emp.app import router as empRouter
from leave.app import router as leaveRouter
from lvStatus.app import router as lvStatusRouter
from lvRequest.app import router as lvRequestRouter
from login import router as loginRouter

Base.metadata.create_all(bind=engine)

app = FastAPI()

origins = [
    "http://localhost",
    "http://localhost:8080",
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)


app.include_router(userRouter)
app.include_router(empRouter)
app.include_router(leaveRouter)
app.include_router(lvStatusRouter)
app.include_router(lvRequestRouter)
app.include_router(loginRouter)


@app.get("/")
def main():
    return "Welcome!"

# First make a alias for the IP
# sudo ifconfig lo0 alias 127.0.0.2
# IP_ADD = '127.0.0.2'
# PORT = 80


IP_ADD = '127.0.0.1'
PORT = 8000

if __name__ == '__main__':
    uvicorn.run(app='app:app', host=IP_ADD, port=PORT, reload=True, debug=True)
