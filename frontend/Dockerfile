FROM node:20-alpine

WORKDIR /app

COPY package.json package-lock.json* ./
RUN npm install --legacy-peer-deps

COPY . .

RUN npm run build   # ✅ construye el frontend

CMD ["npm", "start"]  # ✅ arranca en producción
