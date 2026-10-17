<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos | Liga de Básquetbol</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 40px;
        }

        .contenedor {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 12px;
        }

        h1 { color: #1e293b; }

        a, button {
            display: inline-block;
            padding: 9px 14px;
            border: 0;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .nuevo { background: #ea580c; color: white; }
        .editar { background: #2563eb; color: white; }
        .eliminar { background: #dc2626; color: white; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th { background: #f8fafc; }

        .mensaje {
            background: #dcfce7;
            padding: 12px;
            border-radius: 6px;
            color: #166534;
        }

        .acciones { display: flex; gap: 6px; }
        form { margin: 0; }
    </style>
</head>
<body>
    @include('layouts.menu')
    <div class="contenedor">
        <h1>Gestión de equipos</h1>
        <p>Administra los equipos participantes de la liga.</p>

        @if (session('success'))
            <p class="mensaje">{{ session('success') }}</p>
        @endif

        <a href="{{ route('equipos.create') }}" class="nuevo">
            + Registrar equipo
        </a>

        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ciudad</th>
                    <th>Entrenador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->nombre }}</td>
                        <td>{{ $equipo->ciudad ?? 'No indicado' }}</td>
                        <td>{{ $equipo->entrenador ?? 'No indicado' }}</td>
                        <td>
                            <div class="acciones">
                                <a class="editar"
                                   href="{{ route('equipos.edit', $equipo) }}">
                                    Editar
                                </a>

                                <form action="{{ route('equipos.destroy', $equipo) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Deseas eliminar este equipo?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="eliminar" type="submit">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Todavía no hay equipos registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>
