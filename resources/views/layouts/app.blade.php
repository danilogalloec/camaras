<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cámaras Daganet</title>

    {{-- Vite: CSS y JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ====== Estilos útiles globales (ligeros) ====== */
        .form-grid{ display:grid; grid-template-columns:1fr; gap:1.25rem; }
        @media (min-width:768px){ .form-grid{ grid-template-columns:1fr 1fr } }
        .form-control{
            display:block; width:100%; padding:0.75rem 1rem;
            border:1px solid #d1d5db; border-radius:0.5rem;
            background:#f9fafb; font-size:0.95rem; color:#111827;
            outline:none; transition:all .2s;
        }
        .form-control:focus{ border-color:#2563eb; box-shadow:0 0 0 2px #93c5fd; background:#fff; }

        /* ====== Impresión / PDF ======
           No tocamos el layout general para no romper estilos.
           Solo ocultamos lo que no debe imprimirse
           y expandimos .print-area si existe. */
        @media print {
            nav, .no-print { display: none !important; }

            body { background:#fff !important; margin:0 !important; padding:0 !important; }

            .print-area{
                width:100% !important; max-width:100% !important;
                background:#fff !important; box-shadow:none !important; border:none !important;
                padding:0 1.5cm !important; /* margen lateral cómodo */
            }

            table{ page-break-inside:auto; width:100% !important; }
            tr{ page-break-inside:avoid; page-break-after:auto; }
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900">

    {{-- Barra superior (no se imprime) --}}
    <nav class="bg-white shadow-md no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between h-16 items-center">
            @if(auth('admin')->check())
                <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-gray-800 hover:text-blue-600">
                    Cámaras Daganet
                </a>
            @elseif(auth('cliente')->check())
                <a href="{{ route('cliente.dashboard') }}" class="text-xl font-bold text-gray-800 hover:text-blue-600">
                    Cámaras Daganet
                </a>
            @else
                <span class="text-xl font-bold text-gray-800">Cámaras Daganet</span>
            @endif

            <div>
                @if(auth('admin')->check())
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                            Cerrar sesión
                        </button>
                    </form>
                @elseif(auth('cliente')->check())
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                            Cerrar sesión
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </nav>

    {{-- Contenido: cada vista maneja su propio contenedor/tarjeta --}}
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
