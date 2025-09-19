from sqlalchemy import Column, Integer, String, ForeignKey, DateTime, Enum
from sqlalchemy.orm import relationship
from app.database import Base
import enum

class VisitStatus(str, enum.Enum):
    scheduled = "scheduled"
    in_progress = "in_progress"
    completed = "completed"

class Visit(Base):
    __tablename__ = "visits"

    id = Column(Integer, primary_key=True, index=True)
    ticket_id = Column(Integer, ForeignKey("tickets.id"))
    fecha = Column(DateTime)
    tecnico = Column(String)
    notas = Column(String)
    estado = Column(Enum(VisitStatus), default=VisitStatus.scheduled)

    ticket = relationship("Ticket", backref="visits")
