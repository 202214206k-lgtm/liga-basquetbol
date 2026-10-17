<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar jugador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 40px;
        }

        form {
            max-width: 500px;
            padding: 25px;
            background: white;
            border-radius: 8px;
        }

        label { display: block; margin-top: 15px; }

        input, select {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            margin-top: 6px;
        }

        button, a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
        }

        button { background: #2563eb; color: white; }
        a { background: #e5e7eb; color: #111827; }

        .error { color: #dc2626; }
    </style>
</head>
<body>
    @include('layouts.menu')

    <h1>Registrar jugador</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('jugadores.store') }}" method="POST">
        @csrf

        <label>Nombres *</label>
        <input type="text" name="nombres"
               value="{{ old('nombres') }}" required>

        <label>Apellidos *</label>
        <input type="text" name="apellidos"
               value="{{ old('apellidos') }}" required>

        <label>Dorsal *</label>
        <input type="number" name="dorsal"
               min="0" max="99" value="{{ old('dorsal') }}" required>

        <label>Posición</label>
        <select name="posicion">
            <option value="">Seleccionar posición</option>
            <option value="Base">Base</option>
            <option value="Escolta">Escolta</option>
            <option value="Alero">Alero</option>
            <option value="Ala-pívot">Ala-pívot</option>
            <option value="Pívot">Pívot</option>
        </select>

        <label>Equipo *</label>
        <select name="equipo_id" required>
            <option value="">Seleccionar equipo</option>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}"
                    {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                    {{ $equipo->nombre }}
                </option>
            @endforeach
        </select>

        <button type="submit">Guardar jugador</button>
        <a href="{{ route('jugadores.index') }}">Volver</a>
    </form>

</body>
</html>
