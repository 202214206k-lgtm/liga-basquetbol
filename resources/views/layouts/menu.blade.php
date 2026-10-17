
<nav style="background:#1e293b;padding:18px 22px;border-radius:8px;
            margin-bottom:25px;display:flex;justify-content:space-between;
            align-items:center;flex-wrap:wrap;gap:15px;">

    <a href="{{ url('/') }}"
       style="color:white;font-size:20px;font-weight:bold;text-decoration:none;">
        🏀 Liga Básquetbol
    </a>

    <div style="display:flex;flex-wrap:wrap;gap:10px;">
        <a href="{{ route('equipos.index') }}"
           style="color:white;text-decoration:none;padding:9px 12px;">
            Equipos
        </a>

        <a href="{{ route('jugadores.index') }}"
           style="color:white;text-decoration:none;padding:9px 12px;">
            Jugadores
        </a>

        <a href="{{ route('partidos.index') }}"
           style="color:white;text-decoration:none;padding:9px 12px;">
            Partidos
        </a>
    </div>
</nav>
