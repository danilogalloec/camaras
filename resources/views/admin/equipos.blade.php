<!DOCTYPE html>
<html>
<head>
    <title>Gestión de Equipos - {{ $cliente->nombre }}</title>
</head>
<body>
    <h1>Gestión de Equipos para {{ $cliente->nombre }}</h1>

    <h2>Lista de equipos</h2>
    @if($cliente->equipos->count() > 0)
        <ul>
            @foreach($cliente->equipos as $equipo)
                <li>
                    <b>{{ $equipo->nombre }}</b>
                    @if($equipo->modelo) (Modelo: {{ $equipo->modelo }}) @endif
                    @if($equipo->serie) - Serie: {{ $equipo->serie }} @endif
                    <br>
                    Instalado el: {{ $equipo->fecha_instalacion ?? 'N/A' }},
                    Garantía: {{ $equipo->garantia_meses }} meses
                    <form method="POST" action="{{ route('admin.equipos.eliminar', $equipo->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay equipos registrados.</p>
    @endif

    <h2>Agregar nuevo equipo</h2>
    <form method="POST" action="{{ route('admin.equipos.agregar', $cliente->id) }}">
        @csrf
        <label>Nombre:</label>
        <input type="text" name="nombre" required><br>
        <label>Modelo:</label>
        <input type="text" name="modelo"><br>
        <label>Serie:</label>
        <input type="text" name="serie"><br>
        <label>Fecha instalación:</label>
        <input type="date" name="fecha_instalacion"><br>
        <label>Garantía (meses):</label>
        <input type="number" name="garantia_meses" value="12"><br>
        <button type="submit">Agregar Equipo</button>
    </form>

    <br>
    <a href="{{ route('admin.clientes') }}">← Volver a Clientes</a>
</body>
</html>
