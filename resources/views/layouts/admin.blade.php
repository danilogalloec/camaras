<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrativo')</title>
    @vite('resources/css/app.css') {{-- asegúrate de tener Tailwind compilado --}}
</head>
<body class="bg-gray-100 min-h-screen text-gray-800">

    {{-- Barra superior --}}
    <header class="bg-gray-800 text-white shadow-md">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <h1 class="text-lg font-bold">Panel Administrativo</h1>
            <nav class="space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('admin.clientes') }}" class="hover:underline">Clientes</a>
                <a href="{{ route('admin.visitas') }}" class="hover:underline">Visitas</a>
            </nav>
        </div>
    </header>

    {{-- Contenido principal --}}
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    {{-- Footer opcional --}}
    <footer class="bg-gray-800 text-gray-200 text-center py-4 mt-8">
        &copy; {{ date('Y') }} Daganet – Administración de Cámaras
    </footer>

</body>
</html>
