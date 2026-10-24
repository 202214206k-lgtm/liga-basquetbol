 <nav class="menu">
    <a href="{{ url('/') }}" class="logo">
        🏀 Liga Básquetbol
    </a>

    <div class="menu-enlaces">
        <a href="{{ url('/') }}" class="menu-enlace">Inicio</a>
        <a href="{{ route('equipos.index') }}" class="menu-enlace">Equipos</a>
        <a href="{{ route('jugadores.index') }}" class="menu-enlace">Jugadores</a>
        <a href="{{ route('partidos.index') }}" class="menu-enlace">Partidos</a>

        @auth
            <span class="usuario">{{ Auth::user()->name }}</span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-salir">Cerrar sesión</button>
            </form>
        @endauth
    </div>
</nav>