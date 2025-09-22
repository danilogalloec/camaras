@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
        Agregar Equipo a {{ $cliente->nombre }}
    </h1>

    {{-- Estilos fuertes para que los inputs SIEMPRE se vean bien, sin importar el CSS global --}}
    <style>
        .form-grid{display:grid;grid-template-columns:1fr;gap:1.25rem}
        @media (min-width:768px){.form-grid{grid-template-columns:1fr 1fr}}
        .form-control{
            display:block;width:100%;
            padding:0.70rem 0.80rem;
            border:1px solid #d1d5db !important; /* fuerza borde visible */
            border-radius:0.5rem;
            background:#fff !important;
            color:#111827 !important;
            line-height:1.5;
        }
        .form-control::placeholder{color:#9ca3af}
        .form-control:focus{
            outline:0;
            border-color:#2563eb !important;
            box-shadow:0 0 0 3px rgba(37,99,235,.2);
        }
        /* Ajustes consistentes para <input type="date"> */
        input[type="date"].form-control{
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
        }
        /* Safari/WebKit icon alignment */
        input[type="date"].form-control::-webkit-date-and-time-value{text-align:left}
        textarea.form-control{resize:vertical;min-height:110px}
    </style>

    <div class="bg-white shadow-md rounded-lg p-8">
        <form action="{{ route('admin.clientes.equipos.store', $cliente->id) }}" method="POST" class="space-y-8">
            @csrf

            <div class="form-grid">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo</label>
                    <input type="text" name="tipo" required class="form-control" placeholder="Ej: DVR, Cámara IP, NVR…">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marca</label>
                    <input type="text" name="marca" class="form-control" placeholder="Ej: Hikvision, Dahua…">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Modelo</label>
                    <input type="text" name="modelo" class="form-control" placeholder="Ej: DS-2CD1023G0">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Número de Serie</label>
                    <input type="text" name="numero_serie" required class="form-control" placeholder="Ej: SN1234567890">
                </div>

<div>
    <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Instalación</label>
    <input type="text" name="fecha_instalacion"
           required
           class="form-control datepicker"
           placeholder="Selecciona la fecha">
</div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Garantía (meses)</label>
                    <input type="number" name="garantia_meses" required class="form-control" placeholder="Ej: 12">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Observaciones</label>
                <textarea name="observaciones" class="form-control" placeholder="Notas, estado, ubicación, etc."></textarea>
            </div>

            <div class="flex justify-between items-center mt-6">
                <a href="{{ route('admin.clientes.show', $cliente->id) }}"
                   class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-1">
                    ← Volver al cliente
                </a>
                <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-blue-600 text-white text-lg font-bold rounded-md shadow hover:bg-blue-700 transition">
                    Guardar Equipo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
