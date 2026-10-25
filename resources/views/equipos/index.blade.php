<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos | Liga de Básquetbol</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        .contenedor-modulo {
            max-width: 1200px;
            margin: auto;
            padding: 28px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 4px 12px #0f172a0a;
        }

        .encabezado-modulo {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 22px;
        }

        .encabezado-modulo p {
            color: #64748b;
            margin-bottom: 0;
        }

        .tabla-contenedor {
            width: 100%;
            overflow-x: auto;
        }

        .tabla-datos {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .tabla-datos th,
        .tabla-datos td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        .tabla-datos th {
            background: #f8fafc;
            color: #475569;
            font-size: 13px;
            text-transform: uppercase;
        }

        .tabla-datos tbody tr:hover {
            background: #f8fafc;
        }

        .boton {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 7px;
            color: white;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .nuevo {
            background: #2563eb;
        }

        .nuevo:hover {
            background: #1d4ed8;
        }

        .editar {
            background: #0f766e;
        }

        .editar:hover {
            background: #115e59;
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
            flex-wrap: wrap;
        }

        .acciones form {
            margin: 0;
        }

        .mensaje {
            padding: 13px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            color: #166534;
            background: #dcfce7;
        }

        .vacio {
            padding: 25px !important;
            text-align: center !important;
            color: #64748b;
        }

        @media (max-width: 650px) {
            .contenedor-modulo {
                padding: 16px;
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
                    <h1>Gestión de equipos</h1>
                    <p>Administra los equipos participantes de la liga.</p>
                </div>

                <a href="{{ route('equipos.create') }}" class="boton nuevo">
                    + Registrar equipo
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
                                        <a class="boton editar"
                                           href="{{ route('equipos.edit', $equipo) }}">
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('equipos.destroy', $equipo) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar este equipo?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="boton eliminar" type="submit">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="vacio">
                                    Todavía no hay equipos registrados.
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
