<!DOCTYPE html>
<html>
<head>
    <title>Administrar Clientes</title>
</head>
<body>
    <h1>👨‍💼 Administración de Clientes</h1>

    <h2>Crear Cliente</h2>
    <form method="POST" action="{{ route('admin.clientes.crear') }}">
        @csrf
        <input type="text" name="cedula" placeholder="Cédula" required>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="telefono" placeholder="Teléfono">
        <input type="email" name="correo" placeholder="Correo">
        <input type="text" name="direccion" placeholder="Dirección">
        <input type="date" name="fecha_instalacion" required>
        <input type="number" name="tiempo_garantia_meses" placeholder="Garantía en meses" required>
        <button type="submit">Crear</button>
    </form>

    <h2>Lista de Clientes</h2>
    <table border="1">
        <tr>
            <th>Cédula</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Acciones</th>
        </tr>
        @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->cedula }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->correo }}</td>
                <td>
                    <a href="{{ route('admin.equipos', $cliente->id) }}">⚙️ Equipos</a> |
                    <form action="{{ route('admin.clientes.eliminar', $cliente->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">❌ Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
