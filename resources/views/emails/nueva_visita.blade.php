<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nueva Visita Técnica</title>
</head>
<body>
    <h1>Nueva Visita Técnica Agendada</h1>

    <p><b>Cliente:</b> {{ $visita->cliente->nombre }} ({{ $visita->cliente->cedula }})</p>
    <p><b>Correo:</b> {{ $visita->cliente->correo ?? '—' }}</p>
    <p><b>Teléfono:</b> {{ $visita->cliente->telefono ?? '—' }}</p>
    <p><b>Fecha de visita:</b> {{ $visita->fecha_visita }}</p>
    <p><b>Comentario:</b> {{ $visita->comentario }}</p>

    <hr>
    <p>Por favor coordinar con el cliente lo antes posible.</p>
</body>
</html>
