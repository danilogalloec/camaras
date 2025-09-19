"use client";
import { useState } from "react";

export default function Home() {
  const [cedula, setCedula] = useState("");
  const [data, setData] = useState<any>(null);

  const buscar = async () => {
    const res = await fetch(`https://api.camaras.daganet.net/clients/${cedula}`);
    if (res.ok) {
      setData(await res.json());
    } else {
      setData({ error: "Cliente no encontrado" });
    }
  };

  return (
    <div className="p-8">
      <h1 className="text-2xl">Consulta de cliente</h1>
      <input
        value={cedula}
        onChange={(e) => setCedula(e.target.value)}
        placeholder="Ingrese cédula"
        className="border p-2 mr-2"
      />
      <button onClick={buscar} className="bg-blue-500 text-white px-4 py-2">Buscar</button>
      <pre>{JSON.stringify(data, null, 2)}</pre>
    </div>
  );
}
