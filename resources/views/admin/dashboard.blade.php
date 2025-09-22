@extends('layouts.app')

@section('content')
<style>
  /* ===== Layout del dashboard ===== */
  .dash { max-width: 1120px; margin: 0 auto; padding: 24px 16px; }
  .dash h1 { font-weight: 800; font-size: 28px; color: #111827; margin: 0 0 6px; }
  .dash p.lead { color:#6b7280; margin:0 0 24px; }

  /* ===== Grid de métricas ===== */
  .cards { display:grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 16px; margin-bottom: 24px; }
  @media (min-width: 768px) { .cards { grid-template-columns: repeat(4, minmax(0, 1fr)); } }

  /* ===== Grid de acciones ===== */
  .actions { display:grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 16px; }
  @media (min-width: 768px) { .actions { grid-template-columns: repeat(4, minmax(0, 1fr)); } }

  /* ===== Tarjetas ===== */
  .card { background:#fff; border-radius:14px; padding:18px; text-align:center; box-shadow:0 1px 6px rgba(0,0,0,.08); }
  .metric { font-weight:800; font-size:26px; line-height:1; margin-bottom:4px; }
  .muted  { color:#6b7280; font-size:13px; }

  /* ===== Botones ===== */
  .btn { display:flex; flex-direction:column; align-items:center; justify-content:center;
         padding:22px 12px; border-radius:14px; color:#fff; font-weight:700; text-align:center;
         box-shadow:0 1px 6px rgba(0,0,0,.08); text-decoration:none; transition: all .2s; min-height: 112px; }
  .btn svg { width:22px; height:22px; margin-bottom:8px; }
  .btn-blue   { background:#2563eb; } .btn-blue:hover   { background:#1e40af; }
  .btn-purple { background:#7c3aed; } .btn-purple:hover { background:#5b21b6; }
  .btn-green  { background:#16a34a; } .btn-green:hover  { background:#166534; }
  .btn-yellow { background:#f59e0b; } .btn-yellow:hover { background:#b45309; }
</style>

<div class="dash">
  {{-- Encabezado --}}
  <h1>Bienvenido, <span style="color:#2563eb">{{ $admin->name }}</span></h1>
  <p class="lead">Has iniciado sesión correctamente como administrador.</p>

  {{-- Métricas (4 columnas en md+) --}}
  <div class="cards">
    <div class="card">
      <div class="metric" style="color:#2563eb">{{ $totalClientes }}</div>
      <div class="muted">Clientes</div>
    </div>
    <div class="card">
      <div class="metric" style="color:#4f46e5">{{ $totalVisitas }}</div>
      <div class="muted">Visitas Totales</div>
    </div>
    <div class="card">
      <div class="metric" style="color:#d97706">{{ $visitasPendientes }}</div>
      <div class="muted">Visitas Pendientes</div>
    </div>
    <div class="card">
      <div class="metric" style="color:#16a34a">{{ $visitasAtendidas }}</div>
      <div class="muted">Visitas Atendidas</div>
    </div>
  </div>

  {{-- Acciones (4 columnas en md+) --}}
  <div class="actions">
    {{-- Gestionar clientes --}}
    <a href="{{ route('admin.clientes') }}" class="btn btn-blue">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5.121 17.804A3 3 0 007.757 19h8.486a3 3 0 002.636-1.196M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
      </svg>
      Gestionar Clientes
    </a>

    {{-- Agregar cliente (ruta correcta) --}}
    <a href="{{ route('admin.clientes.nuevo') }}" class="btn btn-purple">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
      </svg>
      Agregar Cliente
    </a>

    {{-- Gestionar visitas (usa tu ruta admin.visitas) --}}
    <a href="{{ route('admin.visitas') }}" class="btn btn-green">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 8v4l3 3m6-9a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      Gestionar Visitas
    </a>

    {{-- Cotizaciones --}}
    <a href="{{ route('admin.cotizaciones.index') }}" class="btn btn-yellow">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18" />
      </svg>
      Cotizaciones
    </a>
  </div>
</div>
@endsection
