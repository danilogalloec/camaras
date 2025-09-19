from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from app.database import get_db
from app.models.client import Client

router = APIRouter()

@router.get("/clients/{cedula}")
def get_client(cedula: str, db: Session = Depends(get_db)):
    client = db.query(Client).filter(Client.cedula == cedula).first()
    if not client:
        raise HTTPException(status_code=404, detail="Cliente no encontrado")
    return client
