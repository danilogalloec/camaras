# frontend/Dockerfile
FROM node:20-alpine

# Directorio de trabajo
WORKDIR /app

# Copiar package.json y lock primero para aprovechar caché
COPY package*.json ./

# Instalar dependencias (incluye next, react, etc.)
RUN npm install --legacy-peer-deps

# Copiar el resto del código
COPY . .

# Puerto de Next.js
EXPOSE 3000

# Comando de desarrollo
CMD ["npm", "run", "dev"]
