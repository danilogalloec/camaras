<!DOCTYPE html>
<html>
<head>
    <title>Mis Reportes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>📊 Reportes de {{ $cliente->nombre }}</h1>

    <h2>Mis Datos</h2>
    <ul>
        <li><b>Cédula:</b> {{ $cliente->cedula }}</li>
        <li><b>Correo:</b> {{ $cliente->correo }}</li>
        <li><b>Teléfono:</b> {{ $cliente->telefono }}</li>
        <li><b>Dirección:</b> {{ $cliente->direccion }}</li>
        <li><b>Garantía hasta:</b> {{ $fechaFinGarantia->toDateString() }}</li>
    </ul>

    <h2>Mis Equipos</h2>
    <ul>
        @forelse($equipos as $equipo)
            <li>{{ $equipo->tipo }} ({{ $equipo->marca }}) - Serie: {{ $equipo->numero_serie }}</li>
        @empty
            <li>No tienes equipos registrados.</li>
        @endforelse
    </ul>

    <h2>Visitas Técnicas</h2>
    <ul>
        <li><b>Pendientes:</b> {{ $visitasPendientes }}</li>
        <li><b>Atendidas:</b> {{ $visitasAtendidas }}</li>
    </ul>

    <h2>📈 Historial de Visitas por Mes</h2>
    <canvas id="visitasChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('visitasChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($visitasPorMes->keys()) !!},
                datasets: [{
                    label: 'Visitas',
                    data: {!! json_encode($visitasPorMes->values()) !!},
                    backgroundColor: 'orange'
                }]
            }
        });
    </script>

    <br>
    <a href="{{ route('cliente.dashboard') }}">🏠 Volver al Dashboard</a>
</body>
</html>
