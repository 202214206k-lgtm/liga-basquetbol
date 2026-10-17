<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Liga de Básquetbol</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 25px;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .contenedor {
            max-width: 1100px;
            margin: auto;
        }

        h1 {
            margin-bottom: 8px;
        }

        .descripcion {
            color: #64748b;
            margin-bottom: 30px;
        }

        .tarjetas {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .tarjeta {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px #0000000d;
            border-left: 5px solid #2563eb;
        }

        .tarjeta h2 {
            font-size: 16px;
            color: #64748b;
            margin-top: 0;
        }

        .numero {
            font-size: 36px;
            font-weight: bold;
            margin: 15px 0;
        }

        .enlace {
            display: inline-block;
            margin-top: 8px;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .enlace:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="contenedor">

        @include('layouts.menu')

        <h1>Panel principal</h1>
        <p class="descripcion">
            Resumen general de la gestión de la liga de básquetbol.
        </p>

        <div class="tarjetas">

            <div class="tarjeta">
                <h2>Equipos registrados</h2>
                <p class="numero">{{ $totalEquipos }}</p>
                <a class="enlace" href="{{ route('equipos.index') }}">
                    Gestionar equipos →
                </a>
            </div>

            <div class="tarjeta">
                <h2>Jugadores registrados</h2>
                <p class="numero">{{ $totalJugadores }}</p>
                <a class="enlace" href="{{ route('jugadores.index') }}">
                    Gestionar jugadores →
                </a>
            </div>

            <div class="tarjeta">
                <h2>Partidos registrados</h2>
                <p class="numero">{{ $totalPartidos }}</p>
                <a class="enlace" href="{{ route('partidos.index') }}">
                    Gestionar partidos →
                </a>
            </div>

        </div>
    </div>
</body>
</html>
