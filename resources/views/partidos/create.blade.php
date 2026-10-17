<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar partido</title>

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
    <h1>Registrar partido</h1>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($equipos->count() < 2)
        <p>Debes registrar al menos dos equipos activos para programar un partido.</p>
        <a href="{{ route('equipos.index') }}">Ir a equipos</a>
    @else
        <form action="{{ route('partidos.store') }}" method="POST">
            @csrf

            <label>Equipo local *</label>
            <select name="equipo_local_id" required>
                <option value="">Seleccionar equipo local</option>
                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}"
                        {{ old('equipo_local_id') == $equipo->id ? 'selected' : '' }}>
                        {{ $equipo->nombre }}
                    </option>
                @endforeach
            </select>

            <label>Equipo visitante *</label>
            <select name="equipo_visitante_id" required>
                <option value="">Seleccionar equipo visitante</option>
                @foreach ($equipos as $equipo)
                    <option value="{{ $equipo->id }}"
                        {{ old('equipo_visitante_id') == $equipo->id ? 'selected' : '' }}>
                        {{ $equipo->nombre }}
                    </option>
                @endforeach
            </select>

            <label>Fecha y hora *</label>
            <input type="datetime-local" name="fecha"
                   value="{{ old('fecha') }}" required>

            <label>Lugar del encuentro</label>
            <input type="text" name="lugar"
                   value="{{ old('lugar') }}"
                   placeholder="Ej. Coliseo de Cusco">

            <label>Puntos del equipo local *</label>
            <input type="number" name="puntos_local"
                   min="0" max="65535"
                   value="{{ old('puntos_local', 0) }}" required>

            <label>Puntos del equipo visitante *</label>
            <input type="number" name="puntos_visitante"
                   min="0" max="65535"
                   value="{{ old('puntos_visitante', 0) }}" required>

            <label>Estado del partido *</label>
            <select name="estado" required>
                <option value="programado"
                    {{ old('estado', 'programado') == 'programado' ? 'selected' : '' }}>
                    Programado
                </option>
                <option value="en_juego"
                    {{ old('estado') == 'en_juego' ? 'selected' : '' }}>
                    En juego
                </option>
                <option value="finalizado"
                    {{ old('estado') == 'finalizado' ? 'selected' : '' }}>
                    Finalizado
                </option>
                <option value="suspendido"
                    {{ old('estado') == 'suspendido' ? 'selected' : '' }}>
                    Suspendido
                </option>
            </select>

            <button type="submit">Guardar partido</button>
            <a href="{{ route('partidos.index') }}">Volver</a>
        </form>
    @endif

</body>
</html>
