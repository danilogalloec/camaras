from sqlalchemy import Column, Integer, ForeignKey, Date, String
from sqlalchemy.orm import relationship
from app.database import Base

class Installation(Base):
    __tablename__ = "installations"

    id = Column(Integer, primary_key=True, index=True)
    client_id = Column(Integer, ForeignKey("clients.id"))
    equipos = Column(String)
    warranty_months = Column(Integer)
    fecha_instalacion = Column(Date)

    client = relationship("Client", backref="installations")
