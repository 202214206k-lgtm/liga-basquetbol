
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar equipo</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; padding: 30px; }
        .contenedor { max-width: 600px; margin: auto; background: white; padding: 25px; border-radius: 12px; }
        label { display: block; margin-top: 16px; }
        input { box-sizing: border-box; width: 100%; padding: 10px; margin-top: 6px; border: 1px solid #cbd5e1; border-radius: 6px; }
        button, a { display: inline-block; margin-top: 20px; padding: 10px 14px; border: 0; border-radius: 6px; text-decoration: none; cursor: pointer; }
        button { background: #2563eb; color: white; }
        a { background: #e5e7eb; color: #111827; }
        .error { color: #dc2626; }
    </style>
</head>
<body>
    @include('layouts.menu')
    
    <div class="contenedor">
        <h1>Editar equipo</h1>

        @if ($errors->any())
            <ul class="error">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('equipos.update', $equipo) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nombre">Nombre del equipo *</label>
            <input id="nombre" name="nombre" type="text"
                   value="{{ old('nombre', $equipo->nombre) }}" required maxlength="100">

            <label for="ciudad">Ciudad</label>
            <input id="ciudad" name="ciudad" type="text"
                   value="{{ old('ciudad', $equipo->ciudad) }}" maxlength="100">

            <label for="entrenador">Entrenador</label>
            <input id="entrenador" name="entrenador" type="text"
                   value="{{ old('entrenador', $equipo->entrenador) }}" maxlength="100">

            <button type="submit">Actualizar equipo</button>
            <a href="{{ route('equipos.index') }}">Volver</a>
        </form>
    </div>
</body>
</html>
