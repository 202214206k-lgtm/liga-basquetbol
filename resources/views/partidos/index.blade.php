<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de partidos</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f9;
        }

        h1 { color: #1e293b; }

        a, button {
            display: inline-block;
            padding: 9px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .nuevo { background: #2563eb; color: white; }
        .editar { background: #f59e0b; color: white; }
        .eliminar { background: #dc2626; color: white; }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th { background: #1e293b; color: white; }

        .mensaje {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            margin: 15px 0;
            border-radius: 5px;
        }

        .acciones { white-space: nowrap; }
        .acciones form { display: inline; }

        @media (max-width: 800px) {
            body { margin: 15px; }
            .tabla-contenedor { overflow-x: auto; }
        }
    </style>
</head>

<body>
    @include('layouts.menu')

    <h1>Gestión de partidos</h1>

    @if (session('success'))
        <div class="mensaje">{{ session('success') }}</div>
    @endif

    <a class="nuevo" href="{{ route('partidos.create') }}">
        + Registrar partido
    </a>

    <div class="tabla-contenedor">
        <table>
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
                        <td>{{ $partido->equipoLocal->nombre ?? 'Sin equipo' }}</td>

                        <td>
                            {{ $partido->puntos_local }}
                            -
                            {{ $partido->puntos_visitante }}
                        </td>

                        <td>{{ $partido->equipoVisitante->nombre ?? 'Sin equipo' }}</td>

                        <td>{{ $partido->fecha->format('d/m/Y H:i') }}</td>

                        <td>{{ $partido->lugar ?? 'No especificado' }}</td>

                        <td>{{ ucfirst(str_replace('_', ' ', $partido->estado)) }}</td>

                        <td class="acciones">
                            <a class="editar"
                               href="{{ route('partidos.edit', $partido) }}">
                                Editar
                            </a>

                            <form action="{{ route('partidos.destroy', $partido) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este partido?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="eliminar">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center">
                            Todavía no hay partidos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
