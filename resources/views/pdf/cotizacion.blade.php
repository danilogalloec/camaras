<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cotización {{ $cotizacion->numero_cotizacion }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 30px;
            color: #1f2937;
        }
        h1 {
            text-align: center;
            color: #111827;
            font-size: 22px;
            margin-bottom: 25px;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 8px;
            color: #111827;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 25px;
            font-size: 14px;
        }
        th, td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
            font-weight: bold;
        }
        .totales {
            text-align: right;
            margin-top: 20px;
        }
        .totales p {
            margin: 3px 0;
        }
        .notes-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    <h1>Cotización {{ $cotizacion->numero_cotizacion }}</h1>

    <div class="grid">
        <div>
            <p><span class="section-title">Cliente:</span> {{ $cotizacion->nombre }}</p>
            <p><span class="section-title">Cédula:</span> {{ $cotizacion->cedula }}</p>
            <p><span class="section-title">Correo:</span> {{ $cotizacion->correo }}</p>
            <p><span class="section-title">Celular:</span> {{ $cotizacion->celular }}</p>
        </div>
        <div>
            <p><span class="section-title">Dirección:</span> {{ $cotizacion->direccion }}</p>
            <p><span class="section-title">Validez de la oferta:</span> {{ $cotizacion->validez_oferta }} días</p>
            <p><span class="section-title">Estado:</span> {{ ucfirst($cotizacion->estado) }}</p>
        </div>
    </div>

    <h2 class="section-title">Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Desc.%</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cotizacion->items as $item)
            <tr>
                <td>{{ $item->item }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->precio, 2) }}</td>
                <td>{{ $item->descuento }}%</td>
                <td>${{ number_format($item->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totales">
        <p><strong>Subtotal:</strong> ${{ number_format($cotizacion->subtotal, 2) }}</p>
        <p><strong>Impuesto:</strong> {{ $cotizacion->impuesto }} %</p>
        <p><strong>Total:</strong> ${{ number_format($cotizacion->total, 2) }}</p>
    </div>

    <div class="notes-grid">
        <div>
            <h3 class="section-title">Notas</h3>
            <p>{{ $cotizacion->notas ?: 'Ninguna' }}</p>
        </div>
        <div>
            <h3 class="section-title">Condiciones</h3>
            <p>{{ $cotizacion->condiciones ?: 'Ninguna' }}</p>
        </div>
    </div>
</body>
</html>
