import os

class Settings:
    DATABASE_URL: str = os.getenv("DATABASE_URL", "postgresql://camarasusr:camaras123@db:5432/camarasdb")
    JWT_SECRET: str = os.getenv("JWT_SECRET", "supersecret")
    JWT_ALGORITHM: str = os.getenv("JWT_ALGORITHM", "HS256")

settings = Settings()
