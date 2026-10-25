<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar partido</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        .formulario-contenedor {
            max-width: 750px;
            margin: 0 auto;
        }

        .subtitulo {
            color: #64748b;
            margin-bottom: 25px;
        }

        .formulario {
            background: white;
            padding: 30px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 12px #0f172a0a;
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #334155;
        }

        .campo input,
        .campo select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            font-size: 15px;
        }

        .campo input:focus,
        .campo select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #2563eb20;
        }

        .fila-equipos,
        .fila-puntos {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .errores {
            margin-bottom: 20px;
            padding: 15px;
            color: #b91c1c;
            background: #fee2e2;
            border-radius: 8px;
        }

        .botones {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 25px;
        }

        .boton-formulario {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
        }

        .guardar {
            color: white;
            background: #2563eb;
        }

        .guardar:hover {
            background: #1d4ed8;
        }

        .volver {
            color: #334155;
            background: #e2e8f0;
        }

        .volver:hover {
            background: #cbd5e1;
        }

        @media (max-width: 600px) {
            .formulario {
                padding: 20px;
            }

            .fila-equipos,
            .fila-puntos {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }
    </style>
</head>

<body>
    @include('layouts.menu')

    <main class="contenedor formulario-contenedor">
        <h1>Editar partido</h1>
        <p class="subtitulo">
            Modifica los datos del encuentro y guarda los cambios.
        </p>

        @if ($errors->any())
            <div class="errores">
                <strong>Revisa los siguientes errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('partidos.update', $partido) }}"
            method="POST"
            class="formulario"
        >
            @csrf
            @method('PUT')

            <div class="fila-equipos">
                <div class="campo">
                    <label for="equipo_local_id">Equipo local *</label>
                    <select name="equipo_local_id" id="equipo_local_id" required>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}"
                                {{ old('equipo_local_id', $partido->equipo_local_id) == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="equipo_visitante_id">Equipo visitante *</label>
                    <select name="equipo_visitante_id" id="equipo_visitante_id" required>
                        @foreach ($equipos as $equipo)
                            <option value="{{ $equipo->id }}"
                                {{ old('equipo_visitante_id', $partido->equipo_visitante_id) == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="campo">
                <label for="fecha">Fecha y hora *</label>
                <input
                    type="datetime-local"
                    name="fecha"
                    id="fecha"
                    value="{{ old('fecha', $partido->fecha->format('Y-m-d\TH:i')) }}"
                    required
                >
            </div>

            <div class="campo">
                <label for="lugar">Lugar del encuentro</label>
                <input
                    type="text"
                    name="lugar"
                    id="lugar"
                    value="{{ old('lugar', $partido->lugar) }}"
                    placeholder="Ej. Coliseo de Cusco"
                >
            </div>

            <div class="fila-puntos">
                <div class="campo">
                    <label for="puntos_local">Puntos del equipo local *</label>
                    <input
                        type="number"
                        name="puntos_local"
                        id="puntos_local"
                        min="0"
                        max="65535"
                        value="{{ old('puntos_local', $partido->puntos_local) }}"
                        required
                    >
                </div>

                <div class="campo">
                    <label for="puntos_visitante">Puntos del equipo visitante *</label>
                    <input
                        type="number"
                        name="puntos_visitante"
                        id="puntos_visitante"
                        min="0"
                        max="65535"
                        value="{{ old('puntos_visitante', $partido->puntos_visitante) }}"
                        required
                    >
                </div>
            </div>

            <div class="campo">
                <label for="estado">Estado del partido *</label>
                <select name="estado" id="estado" required>
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
            </div>

            <div class="botones">
                <button type="submit" class="boton-formulario guardar">
                    Actualizar partido
                </button>

                <a
                    href="{{ route('partidos.index') }}"
                    class="boton-formulario volver"
                >
                    Volver
                </a>
            </div>
        </form>
    </main>
</body>
</html>