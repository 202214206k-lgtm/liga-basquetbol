<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar equipo | Liga Básquetbol</title>
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    <style>
        .editar-equipo {
            max-width: 700px;
            margin: 40px auto;
            padding: 32px;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        }

        .encabezado-edicion {
            margin-bottom: 28px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }

        .encabezado-edicion h1 {
            margin: 0 0 8px;
            color: #1e293b;
            font-size: 28px;
        }

        .encabezado-edicion p {
            margin: 0;
            color: #64748b;
        }

        .campo {
            margin-bottom: 20px;
        }

        .campo label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: 600;
        }

        .campo input {
            box-sizing: border-box;
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .campo input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .campo small {
            display: block;
            margin-top: 6px;
            color: #64748b;
        }

        .errores {
            margin-bottom: 22px;
            padding: 14px 18px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fef2f2;
            color: #b91c1c;
        }

        .acciones-edicion {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 28px;
        }

        .btn-actualizar,
        .btn-volver {
            display: inline-block;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }

        .btn-actualizar {
            background: #2563eb;
            color: white;
        }

        .btn-actualizar:hover {
            background: #1d4ed8;
        }

        .btn-volver {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-volver:hover {
            background: #cbd5e1;
        }

        @media (max-width: 600px) {
            .editar-equipo {
                margin: 20px 12px;
                padding: 22px;
            }

            .encabezado-edicion h1 {
                font-size: 23px;
            }

            .acciones-edicion {
                flex-direction: column;
            }

            .btn-actualizar,
            .btn-volver {
                box-sizing: border-box;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    @include('layouts.menu')

    <main class="editar-equipo">
        <div class="encabezado-edicion">
            <h1>🏀 Editar equipo</h1>
            <p>Modifica la información del equipo seleccionado.</p>
        </div>

        @if ($errors->any())
            <div class="errores">
                <strong>Revisa los siguientes errores:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('equipos.update', $equipo) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="campo">
                <label for="nombre">Nombre del equipo *</label>
                <input
                    id="nombre"
                    name="nombre"
                    type="text"
                    value="{{ old('nombre', $equipo->nombre) }}"
                    maxlength="100"
                    required
                >
                <small>Ingresa el nombre oficial del equipo.</small>
            </div>

            <div class="campo">
                <label for="ciudad">Ciudad</label>
                <input
                    id="ciudad"
                    name="ciudad"
                    type="text"
                    value="{{ old('ciudad', $equipo->ciudad) }}"
                    maxlength="100"
                >
            </div>

            <div class="campo">
                <label for="entrenador">Entrenador</label>
                <input
                    id="entrenador"
                    name="entrenador"
                    type="text"
                    value="{{ old('entrenador', $equipo->entrenador) }}"
                    maxlength="100"
                >
            </div>

            <div class="acciones-edicion">
                <button type="submit" class="btn-actualizar">
                    Guardar cambios
                </button>

                <a href="{{ route('equipos.index') }}" class="btn-volver">
                    Volver a equipos
                </a>
            </div>
        </form>
    </main>
</body>
</html>
