<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar partido</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        .formulario-contenedor {
            max-width: 700px;
            margin: 0 auto;
        }

        .subtitulo {
            color: #64748b;
            margin-bottom: 25px;
        }

        .formulario {
            padding: 30px;
            background: white;
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
            color: #334155;
            font-weight: bold;
        }

        .campo input,
        .campo select {
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
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
            gap: 18px;
        }

        .errores {
            padding: 12px 16px;
            margin-bottom: 20px;
            color: #991b1b;
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 8px;
        }

        .aviso {
            padding: 20px;
            margin-bottom: 20px;
            background: #fff7ed;
            color: #9a3412;
            border: 1px solid #fed7aa;
            border-radius: 10px;
        }

        .botones {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 25px;
        }

        .boton-formulario {
            display: inline-block;
            padding: 12px 17px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
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

        @media (max-width: 650px) {
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
    <div class="contenedor">
        @include('layouts.menu')

        <main class="formulario-contenedor">
            <h1>Registrar partido</h1>

            <p class="subtitulo">
                Programa un encuentro y registra sus datos.
            </p>

            @if ($errors->any())
                <div class="errores">
                    <strong>Revisa los siguientes campos:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if ($equipos->count() < 2)
                <div class="aviso">
                    <strong>No hay suficientes equipos.</strong>
                    <p>Debes registrar al menos dos equipos activos para programar un partido.</p>

                    <a class="boton-formulario volver"
                       href="{{ route('equipos.index') }}">
                        Ir a equipos
                    </a>
                </div>
            @else
                <form
                    class="formulario"
                    action="{{ route('partidos.store') }}"
                    method="POST">

                    @csrf

                    <div class="fila-equipos">
                        <div class="campo">
                            <label for="equipo_local_id">Equipo local *</label>
                            <select id="equipo_local_id" name="equipo_local_id" required>
                                <option value="">Seleccionar equipo local</option>

                                @foreach ($equipos as $equipo)
                                    <option
                                        value="{{ $equipo->id }}"
                                        {{ old('equipo_local_id') == $equipo->id ? 'selected' : '' }}>
                                        {{ $equipo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="campo">
                            <label for="equipo_visitante_id">Equipo visitante *</label>
                            <select id="equipo_visitante_id" name="equipo_visitante_id" required>
                                <option value="">Seleccionar equipo visitante</option>

                                @foreach ($equipos as $equipo)
                                    <option
                                        value="{{ $equipo->id }}"
                                        {{ old('equipo_visitante_id') == $equipo->id ? 'selected' : '' }}>
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
                            id="fecha"
                            name="fecha"
                            value="{{ old('fecha') }}"
                            required>
                    </div>

                    <div class="campo">
                        <label for="lugar">Lugar del encuentro</label>
                        <input
                            type="text"
                            id="lugar"
                            name="lugar"
                            value="{{ old('lugar') }}"
                            placeholder="Ej. Coliseo de Cusco">
                    </div>

                    <div class="fila-puntos">
                        <div class="campo">
                            <label for="puntos_local">Puntos del equipo local *</label>
                            <input
                                type="number"
                                id="puntos_local"
                                name="puntos_local"
                                min="0"
                                max="65535"
                                value="{{ old('puntos_local', 0) }}"
                                required>
                        </div>

                        <div class="campo">
                            <label for="puntos_visitante">Puntos del equipo visitante *</label>
                            <input
                                type="number"
                                id="puntos_visitante"
                                name="puntos_visitante"
                                min="0"
                                max="65535"
                                value="{{ old('puntos_visitante', 0) }}"
                                required>
                        </div>
                    </div>

                    <div class="campo">
                        <label for="estado">Estado del partido *</label>
                        <select id="estado" name="estado" required>
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
                    </div>

                    <div class="botones">
                        <button type="submit" class="boton-formulario guardar">
                            Guardar partido
                        </button>

                        <a
                            href="{{ route('partidos.index') }}"
                            class="boton-formulario volver">
                            Volver
                        </a>
                    </div>
                </form>
            @endif
        </main>
    </div>
</body>
</html>