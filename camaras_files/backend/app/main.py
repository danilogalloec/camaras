from fastapi import FastAPI
from .database import Base, engine
from .routers import auth, clients

app = FastAPI(title="Camaras API")

# Routers
app.include_router(auth.router, prefix="/auth", tags=["Auth"])
app.include_router(clients.router, prefix="/clients", tags=["Clients"])

@app.get("/")
def root():
    return {"message": "API Camaras funcionando 🚀"}
