<nav style="background:#1e293b;padding:18px 22px;border-radius:8px;
            margin-bottom:25px;display:flex;justify-content:space-between;
            align-items:center;flex-wrap:wrap;gap:15px;">

    <a href="{{ url('/') }}"
       style="color:white;font-size:20px;font-weight:bold;text-decoration:none;">
        🏀 Liga Básquetbol
    </a>

    <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">
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

        @auth
            <span style="color:#cbd5e1;padding:9px 5px;">
                {{ Auth::user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}"
                  style="margin:0;">
                @csrf
                <button type="submit"
                        style="background:#dc2626;color:white;border:none;
                               padding:10px 14px;border-radius:6px;
                               cursor:pointer;">
                    Cerrar sesión
                </button>
            </form>
        @endauth
    </div>
</nav>
