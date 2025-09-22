<!DOCTYPE html>
<html>
<head>
    <title>Dashboard de Reportes</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>📊 Reportes del Sistema</h1>

    <h2>Resumen</h2>
    <ul>
        <li><b>Total Clientes:</b> {{ $totalClientes }}</li>
        <li><b>Total Equipos:</b> {{ $totalEquipos }}</li>
        <li><b>Total Visitas:</b> {{ $totalVisitas }}</li>
        <li><b>Visitas Pendientes:</b> {{ $visitasPendientes }}</li>
        <li><b>Visitas Atendidas:</b> {{ $visitasAtendidas }}</li>
    </ul>

    <h2>📈 Instalaciones de Equipos por Mes</h2>
    <canvas id="instalacionesChart" width="400" height="200"></canvas>

    <script>
        const ctx = document.getElementById('instalacionesChart');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($instalacionesPorMes->keys()) !!},
                datasets: [{
                    label: 'Equipos Instalados',
                    data: {!! json_encode($instalacionesPorMes->values()) !!},
                    borderColor: 'blue',
                    backgroundColor: 'lightblue',
                    fill: true,
                    tension: 0.3
                }]
            }
        });
    </script>

    <br>
    <a href="{{ route('admin.clientes') }}">👥 Gestión de Clientes</a> |
    <a href="{{ route('admin.equipos.index') }}">🖥 Gestión de Equipos</a> |
    <a href="{{ route('admin.visitas') }}">📅 Gestión de Visitas</a>

</body>
</html>
