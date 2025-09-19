// frontend/app/layout.tsx
import React from "react";

export const metadata = {
  title: "Cámaras Daganet",
  description: "Gestión de clientes e instalaciones",
};

export default function RootLayout({ children }: { children: React.ReactNode }) {
  return (
    <html lang="es">
      <body>{children}</body>
    </html>
  );
}
