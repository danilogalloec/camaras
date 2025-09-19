# backend/app/database.py
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker, declarative_base
import os

# URL de conexión (puedes definirla en backend/.env también)
DATABASE_URL = os.getenv(
    "DATABASE_URL",
    "postgresql+psycopg2://postgres:postgres@db:5432/camaras"
)

# Motor de conexión
engine = create_engine(DATABASE_URL)

# Sesión para los queries
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

# Base para modelos
Base = declarative_base()

# 👉 Esta función es la que usan los routers
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()
