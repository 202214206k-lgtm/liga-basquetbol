<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar jugador</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f6f9; }
        form { max-width: 500px; padding: 25px; background: white; border-radius: 8px; }
        label { display: block; margin-top: 15px; }
        input, select { width: 100%; box-sizing: border-box; padding: 10px; margin-top: 6px; }
        button, a { display: inline-block; margin-top: 20px; padding: 10px 15px; border: none; border-radius: 5px; text-decoration: none; cursor: pointer; }
        button { background: #2563eb; color: white; }
        a { background: #e5e7eb; color: #111827; }
    </style>
</head>
<body>
    @include('layouts.menu')

    <h1>Editar jugador</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('jugadores.update', $jugador) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nombres</label>
        <input type="text" name="nombres"
               value="{{ old('nombres', $jugador->nombres) }}" required>

        <label>Apellidos</label>
        <input type="text" name="apellidos"
               value="{{ old('apellidos', $jugador->apellidos) }}" required>

        <label>Dorsal</label>
        <input type="number" name="dorsal" min="0" max="99"
               value="{{ old('dorsal', $jugador->dorsal) }}" required>

        <label>Posición</label>
        <select name="posicion">
            <option value="">Seleccionar posición</option>
            @foreach (['Base', 'Escolta', 'Alero', 'Ala-pívot', 'Pívot'] as $posicion)
                <option value="{{ $posicion }}"
                    {{ old('posicion', $jugador->posicion) == $posicion ? 'selected' : '' }}>
                    {{ $posicion }}
                </option>
            @endforeach
        </select>

        <label>Equipo</label>
        <select name="equipo_id" required>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}"
                    {{ old('equipo_id', $jugador->equipo_id) == $equipo->id ? 'selected' : '' }}>
                    {{ $equipo->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit">Actualizar jugador</button>
        <a href="{{ route('jugadores.index') }}">Volver</a>
    </form>

</body>
</html>
