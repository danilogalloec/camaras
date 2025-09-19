#!/bin/bash
set -e

PROJECT_DIR="/opt/camaras"

echo "🚀 Instalando dependencias base..."
sudo apt update && sudo apt install -y git docker.io docker-compose-plugin

echo "📦 Preparando proyecto..."
cd $PROJECT_DIR

echo "🔑 Creando archivo .env..."
cat > backend/.env <<EOL
DATABASE_URL=postgresql+psycopg2://camarasusr:camaras123@db:5432/camarasdb
JWT_SECRET=$(openssl rand -hex 32)
JWT_ALGORITHM=HS256
EOL

echo "🐳 Levantando stack aislado..."
sudo docker compose up -d --build

echo "🗄️ Aplicando migraciones..."
sudo docker compose exec backend alembic upgrade head || echo "⚠️ Migraciones aún no creadas"

echo "✅ Proyecto 'camaras' desplegado correctamente."
echo "➡ Backend: http://$(curl -s ifconfig.me):8001/docs"
echo "➡ Frontend: http://$(curl -s ifconfig.me):3001"
