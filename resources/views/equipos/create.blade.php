<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar equipo | Liga de Básquetbol</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        .formulario-contenedor {
            max-width: 700px;
            margin: 0 auto;
            padding: 30px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 12px #0f172a0a;
        }

        .formulario-contenedor h1 {
            margin-top: 0;
        }

        .subtitulo {
            margin-bottom: 25px;
            color: #64748b;
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

        .campo input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        .campo input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #2563eb20;
        }

        .ayuda {
            display: block;
            margin-top: 6px;
            color: #64748b;
            font-size: 13px;
        }

        .errores {
            margin-bottom: 22px;
            padding: 14px 18px;
            color: #991b1b;
            background: #fee2e2;
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
            padding: 11px 16px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
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
            .formulario-contenedor {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="contenedor">
        @include('layouts.menu')

        <main class="formulario-contenedor">
            <h1>Registrar equipo</h1>
            <p class="subtitulo">
                Completa los datos del equipo participante en la liga.
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

            <form action="{{ route('equipos.store') }}" method="POST">
                @csrf

                <div class="campo">
                    <label for="nombre">Nombre del equipo *</label>
                    <input
                        id="nombre"
                        name="nombre"
                        type="text"
                        value="{{ old('nombre') }}"
                        maxlength="100"
                        required
                    >
                    <small class="ayuda">
                        Escribe el nombre oficial del equipo.
                    </small>
                </div>

                <div class="campo">
                    <label for="ciudad">Ciudad</label>
                    <input
                        id="ciudad"
                        name="ciudad"
                        type="text"
                        value="{{ old('ciudad') }}"
                        maxlength="100"
                    >
                </div>

                <div class="campo">
                    <label for="entrenador">Entrenador</label>
                    <input
                        id="entrenador"
                        name="entrenador"
                        type="text"
                        value="{{ old('entrenador') }}"
                        maxlength="100"
                    >
                </div>

                <div class="botones">
                    <button type="submit" class="boton-formulario guardar">
                        Guardar equipo
                    </button>

                    <a
                        href="{{ route('equipos.index') }}"
                        class="boton-formulario volver"
                    >
                        Volver a equipos
                    </a>
                </div>
            </form>
        </main>
    </div>
</body>
</html>
