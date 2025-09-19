from sqlalchemy import Column, Integer, String, Date
from app.database import Base

class Client(Base):
    __tablename__ = "clients"

    id = Column(Integer, primary_key=True, index=True)
    cedula = Column(String, unique=True, index=True, nullable=False)
    nombre = Column(String, nullable=False)
    telefono = Column(String)
    correo = Column(String)
    direccion = Column(String)
    fecha_instalacion = Column(Date)
