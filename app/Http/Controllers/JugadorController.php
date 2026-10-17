<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\Equipo;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    public function index()
    {
        $jugadores = Jugador::with('equipo')->latest()->get();

        return view('jugadores.index', compact('jugadores'));
    }

    public function create()
    {
        $equipos = Equipo::where('activo', true)->get();

        return view('jugadores.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dorsal' => 'required|integer|min:0|max:99',
            'posicion' => 'nullable|string|max:50',
            'equipo_id' => 'required|exists:equipos,id',
        ]);

        Jugador::create($datos);

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugador registrado correctamente.');
    }

    public function edit(Jugador $jugadore)
    {
        $equipos = Equipo::where('activo', true)->get();

        return view('jugadores.edit', [
            'jugador' => $jugadore,
            'equipos' => $equipos,
        ]);
    }

    public function update(Request $request, Jugador $jugadore)
    {
        $datos = $request->validate([
            'nombres' => 'required|string|max:100',
            'apellidos' => 'required|string|max:100',
            'dorsal' => 'required|integer|min:0|max:99',
            'posicion' => 'nullable|string|max:50',
            'equipo_id' => 'required|exists:equipos,id',
        ]);

        $jugadore->update($datos);

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugador actualizado correctamente.');
    }

    public function destroy(Jugador $jugadore)
    {
        $jugadore->delete();

        return redirect()
            ->route('jugadores.index')
            ->with('success', 'Jugador eliminado correctamente.');
    }
}
