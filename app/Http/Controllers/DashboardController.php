<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use App\Models\Partido;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEquipos = Equipo::count();
        $totalJugadores = Jugador::count();
        $totalPartidos = Partido::count();

        return view('dashboard', compact(
            'totalEquipos',
            'totalJugadores',
            'totalPartidos'
        ));
    }
}
