
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de jugadores</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f9;
        }

        h1 {
            color: #1e293b;
        }

        a, button {
            display: inline-block;
            padding: 9px 14px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .nuevo {
            background: #2563eb;
            color: white;
        }

        .editar {
            background: #f59e0b;
            color: white;
        }

        .eliminar {
            background: #dc2626;
            color: white;
        }

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

        th {
            background: #1e293b;
            color: white;
        }

        .mensaje {
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            margin: 15px 0;
            border-radius: 5px;
        }

        .acciones {
            white-space: nowrap;
        }

        .acciones form {
            display: inline;
        }

        .vacio {
            text-align: center;
            color: #64748b;
        }

        @media (max-width: 768px) {
            body {
                margin: 15px;
            }

            table {
                font-size: 13px;
            }

            th, td {
                padding: 8px;
            }
        }
    </style>
</head>

<body>
    @include('layouts.menu')

    <h1>Gestión de jugadores</h1>

    @if (session('success'))
        <div class="mensaje">
            {{ session('success') }}
        </div>
    @endif

    <a class="nuevo" href="{{ route('jugadores.create') }}">
        + Registrar jugador
    </a>

    <table>
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

                    <td class="acciones">
                        <a class="editar"
                           href="{{ route('jugadores.edit', $jugador) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('jugadores.destroy', $jugador) }}"
                            method="POST"
                            onsubmit="return confirm('¿Estás seguro de eliminar este jugador?')">

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
                    <td colspan="6" class="vacio">
                        Todavía no hay jugadores registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
