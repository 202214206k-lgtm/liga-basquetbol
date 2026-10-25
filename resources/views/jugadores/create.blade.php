<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar jugador</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        .formulario-contenedor {
            max-width: 650px;
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
            font-weight: bold;
            color: #334155;
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

        .errores {
            padding: 12px 16px;
            margin-bottom: 20px;
            color: #991b1b;
            background: #fee2e2;
            border: 1px solid #fecaca;
            border-radius: 8px;
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
        }
    </style>
</head>

<body>
    <div class="contenedor">
        @include('layouts.menu')

        <main class="formulario-contenedor">
            <h1>Registrar jugador</h1>

            <p class="subtitulo">
                Completa los datos del jugador y selecciona su equipo.
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

            <form
                class="formulario"
                action="{{ route('jugadores.store') }}"
                method="POST">

                @csrf

                <div class="campo">
                    <label for="nombres">Nombres *</label>
                    <input
                        type="text"
                        id="nombres"
                        name="nombres"
                        value="{{ old('nombres') }}"
                        required>
                </div>

                <div class="campo">
                    <label for="apellidos">Apellidos *</label>
                    <input
                        type="text"
                        id="apellidos"
                        name="apellidos"
                        value="{{ old('apellidos') }}"
                        required>
                </div>

                <div class="campo">
                    <label for="dorsal">Dorsal *</label>
                    <input
                        type="number"
                        id="dorsal"
                        name="dorsal"
                        min="0"
                        max="99"
                        value="{{ old('dorsal') }}"
                        required>
                </div>

                <div class="campo">
                    <label for="posicion">Posición</label>
                    <select id="posicion" name="posicion">
                        <option value="">Seleccionar posición</option>
                        @foreach (['Base', 'Escolta', 'Alero', 'Ala-pívot', 'Pívot'] as $posicion)
                            <option
                                value="{{ $posicion }}"
                                {{ old('posicion') == $posicion ? 'selected' : '' }}>
                                {{ $posicion }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="equipo_id">Equipo *</label>
                    <select id="equipo_id" name="equipo_id" required>
                        <option value="">Seleccionar equipo</option>

                        @foreach ($equipos as $equipo)
                            <option
                                value="{{ $equipo->id }}"
                                {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>
                                {{ $equipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="botones">
                    <button type="submit" class="boton-formulario guardar">
                        Guardar jugador
                    </button>

                    <a
                        href="{{ route('jugadores.index') }}"
                        class="boton-formulario volver">
                        Volver
                    </a>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
```