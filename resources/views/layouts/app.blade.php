<style>
    .menu-principal {
        background: #1e293b;
        padding: 18px 22px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .menu-principal .marca {
        color: white;
        font-size: 20px;
        font-weight: bold;
        text-decoration: none;
    }

    .menu-principal .enlaces {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .menu-principal .enlaces a {
        color: white;
        text-decoration: none;
        padding: 9px 12px;
        border-radius: 5px;
        transition: background 0.2s;
    }

    .menu-principal .enlaces a:hover {
        background: #334155;
    }

    @media (max-width: 600px) {
        .menu-principal {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<nav class="menu-principal">
    <a href="{{ url('/') }}" class="marca">
        🏀 Liga Básquetbol
    </a>

    <div class="enlaces">
        <a href="{{ route('equipos.index') }}">Equipos</a>
        <a href="{{ route('jugadores.index') }}">Jugadores</a>
        <a href="{{ route('partidos.index') }}">Partidos</a>
    </div>
</nav>
