<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Liga de Básquetbol</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
 
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
