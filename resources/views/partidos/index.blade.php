<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de partidos</title>

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
            border: 1px solid #e2e8f0;
            border-radius: 12px;
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

        .marcador {
            color: #0f172a;
            font-size: 16px;
            font-weight: bold;
            text-align: center !important;
            white-space: nowrap;
        }

        .estado {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            background: #e2e8f0;
            color: #334155;
            font-size: 12px;
            font-weight: bold;
            white-space: nowrap;
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
            border: 1px solid #bbf7d0;
            border-radius: 8px;
        }

        .vacio {
            padding: 30px !important;
            text-align: center !important;
            color: #64748b;
        }

        @media (max-width: 800px) {
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
                    <h1>Gestión de partidos</h1>
                    <p class="subtitulo">
                        Consulta los encuentros, marcadores y resultados de la liga.
                    </p>
                </div>

                <a class="boton nuevo" href="{{ route('partidos.create') }}">
                    + Registrar partido
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
                            <th>Equipo local</th>
                            <th>Marcador</th>
                            <th>Equipo visitante</th>
                            <th>Fecha y hora</th>
                            <th>Lugar</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($partidos as $partido)
                            <tr>
                                <td>
                                    {{ $partido->equipoLocal->nombre ?? 'Sin equipo' }}
                                </td>

                                <td class="marcador">
                                    {{ $partido->puntos_local }}
                                    -
                                    {{ $partido->puntos_visitante }}
                                </td>

                                <td>
                                    {{ $partido->equipoVisitante->nombre ?? 'Sin equipo' }}
                                </td>

                                <td>
                                    {{ $partido->fecha->format('d/m/Y H:i') }}
                                </td>

                                <td>
                                    {{ $partido->lugar ?? 'No especificado' }}
                                </td>

                                <td>
                                    <span class="estado">
                                        {{ ucfirst(str_replace('_', ' ', $partido->estado)) }}
                                    </span>
                                </td>

                                <td>
                                    <div class="acciones">
                                        <a
                                            class="boton editar"
                                            href="{{ route('partidos.edit', $partido) }}">
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('partidos.destroy', $partido) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este partido?')">

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
                                <td colspan="7" class="vacio">
                                    Todavía no hay partidos registrados.
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
