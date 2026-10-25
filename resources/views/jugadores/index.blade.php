<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de jugadores</title>

    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        .contenedor-modulo {
            max-width: 1200px;
            margin: 0 auto;
        }

        .encabezado-modulo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        .subtitulo {
            color: #64748b;
            margin-top: 5px;
        }

        .tabla-contenedor {
            overflow-x: auto;
            margin-top: 22px;
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 12px #0f172a0a;
        }

        .tabla-datos {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        .tabla-datos th,
        .tabla-datos td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .tabla-datos th {
            background: #0f172a;
            color: white;
            font-size: 13px;
        }

        .tabla-datos tbody tr:hover {
            background: #f8fafc;
        }

        .boton {
            display: inline-block;
            padding: 9px 13px;
            border: none;
            border-radius: 7px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .nuevo {
            background: #2563eb;
        }

        .nuevo:hover {
            background: #1d4ed8;
        }

        .editar {
            background: #f59e0b;
        }

        .eliminar {
            background: #dc2626;
        }

        .eliminar:hover {
            background: #b91c1c;
        }

        .acciones {
            display: flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
        }

        .acciones form {
            margin: 0;
        }

        .mensaje {
            padding: 13px 16px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
            border-radius: 8px;
            border: 1px solid #bbf7d0;
        }

        .vacio {
            padding: 30px !important;
            text-align: center !important;
            color: #64748b;
        }

        @media (max-width: 650px) {
            .tabla-datos th,
            .tabla-datos td {
                padding: 10px;
                font-size: 13px;
            }

            .encabezado-modulo {
                align-items: flex-start;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="contenedor">
        @include('layouts.menu')

        <main class="contenedor-modulo">
            <div class="encabezado-modulo">
                <div>
                    <h1>Gestión de jugadores</h1>
                    <p class="subtitulo">
                        Administra los jugadores y sus equipos.
                    </p>
                </div>

                <a class="boton nuevo" href="{{ route('jugadores.create') }}">
                    + Registrar jugador
                </a>
            </div>

            @if (session('success'))
                <div class="mensaje">
                    {{ session('success') }}
                </div>
            @endif

            <div class="tabla-contenedor">
                <table class="tabla-datos">
                    <thead>
                        <tr>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Dorsal</th>
                            <th>Posición</th>
                            <th>Equipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($jugadores as $jugador)
                            <tr>
                                <td>{{ $jugador->nombres }}</td>
                                <td>{{ $jugador->apellidos }}</td>
                                <td>{{ $jugador->dorsal }}</td>
                                <td>{{ $jugador->posicion ?? 'No especificada' }}</td>
                                <td>{{ $jugador->equipo->nombre ?? 'Sin equipo' }}</td>

                                <td>
                                    <div class="acciones">
                                        <a class="boton editar"
                                           href="{{ route('jugadores.edit', $jugador) }}">
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('jugadores.destroy', $jugador) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este jugador?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="boton eliminar">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="vacio">
                                    Todavía no hay jugadores registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
```