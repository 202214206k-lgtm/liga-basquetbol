
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar partido</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f9;
        }

        form {
            max-width: 550px;
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

    <h1>Editar partido</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('partidos.update', $partido) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Equipo local *</label>
        <select name="equipo_local_id" required>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}"
                    {{ old('equipo_local_id', $partido->equipo_local_id) == $equipo->id ? 'selected' : '' }}>
                    {{ $equipo->nombre }}
                </option>
            @endforeach
        </select>

        <label>Equipo visitante *</label>
        <select name="equipo_visitante_id" required>
            @foreach ($equipos as $equipo)
                <option value="{{ $equipo->id }}"
                    {{ old('equipo_visitante_id', $partido->equipo_visitante_id) == $equipo->id ? 'selected' : '' }}>
                    {{ $equipo->nombre }}
                </option>
            @endforeach
        </select>

        <label>Fecha y hora *</label>
        <input type="datetime-local" name="fecha"
            value="{{ old('fecha', $partido->fecha->format('Y-m-d\TH:i')) }}" required>

        <label>Lugar del encuentro</label>
        <input type="text" name="lugar"
            value="{{ old('lugar', $partido->lugar) }}"
            placeholder="Ej. Coliseo de Cusco">

        <label>Puntos del equipo local *</label>
        <input type="number" name="puntos_local" min="0" max="65535"
            value="{{ old('puntos_local', $partido->puntos_local) }}" required>

        <label>Puntos del equipo visitante *</label>
        <input type="number" name="puntos_visitante" min="0" max="65535"
            value="{{ old('puntos_visitante', $partido->puntos_visitante) }}" required>

        <label>Estado del partido *</label>
        <select name="estado" required>
            @foreach ([
                'programado' => 'Programado',
                'en_juego' => 'En juego',
                'finalizado' => 'Finalizado',
                'suspendido' => 'Suspendido'
            ] as $valor => $texto)
                <option value="{{ $valor }}"
                    {{ old('estado', $partido->estado) == $valor ? 'selected' : '' }}>
                    {{ $texto }}
                </option>
            @endforeach
        </select>

        <button type="submit">Actualizar partido</button>
        <a href="{{ route('partidos.index') }}">Volver</a>
    </form>

</body>
</html>
