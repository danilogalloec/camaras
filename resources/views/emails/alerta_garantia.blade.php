<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Alerta de Garantía</title>
</head>
<body>
    <h1>Hola {{ $cliente->nombre }}</h1>

    <p>Queremos informarte que tu garantía está por vencer.</p>

    <p><b>Fecha de instalación:</b> {{ $cliente->fecha_instalacion }}</p>
    <p><b>Fin de garantía:</b> {{ $fecha_fin->toDateString() }}</p>
    <p><b>Días restantes:</b> {{ $dias_restantes }}</p>

    <p>Si necesitas soporte adicional o renovación de servicios, por favor contáctanos.</p>

    <br>
    <p>Atentamente,</p>
    <p><b>Equipo de Soporte Cámaras</b></p>
</body>
</html>
