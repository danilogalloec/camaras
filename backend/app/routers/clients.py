from fastapi import APIRouter

router = APIRouter()

@router.get("/{cedula}")
def get_client(cedula: str):
    return {"cedula": cedula, "nombre": "Cliente de prueba"}
