<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<style>
body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
h1 { font-size: 20px; margin-bottom: 20px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
th { background: #f3f4f6; }
.text-right { text-align: right; }
</style>
</head>
<body>
    <h1>Cotización {{ $cotizacion->numero_cotizacion }}</h1>
    <p><strong>Cliente:</strong> {{ $cotizacion->nombre }}</p>
    <p><strong>Cédula:</strong> {{ $cotizacion->cedula }}</p>
    <p><strong>Correo:</strong> {{ $cotizacion->correo }}</p>
    <p><strong>Celular:</strong> {{ $cotizacion->celular }}</p>
    <p><strong>Dirección:</strong> {{ $cotizacion->direccion }}</p>
    <p><strong>Validez de la oferta:</strong> {{ $cotizacion->validez_oferta }} días</p>

    <h2>Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item</th><th>Cantidad</th><th>Precio</th><th>Desc.%</th><th>Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cotizacion->items as $item)
            <tr>
                <td>{{ $item->item }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->precio,2) }}</td>
                <td>{{ $item->descuento }}%</td>
                <td>${{ number_format($item->total,2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <p class="text-right"><strong>Subtotal:</strong> ${{ number_format($cotizacion->subtotal,2) }}</p>
    <p class="text-right"><strong>Impuesto:</strong> {{ $cotizacion->impuesto }}%</p>
    <p class="text-right"><strong>Total:</strong> ${{ number_format($cotizacion->total,2) }}</p>

    <p><strong>Notas:</strong> {{ $cotizacion->notas ?: 'Nada' }}</p>
    <p><strong>Condiciones:</strong> {{ $cotizacion->condiciones ?: 'Nada' }}</p>
</body>
</html>
