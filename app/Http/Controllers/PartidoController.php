<?php

namespace App\Http\Controllers;

use App\Models\Partido;
use App\Models\Equipo;
use Illuminate\Http\Request;

class PartidoController extends Controller
{
    public function index()
    {
        $partidos = Partido::with(['equipoLocal', 'equipoVisitante'])
            ->latest('fecha')
            ->get();

        return view('partidos.index', compact('partidos'));
    }

    public function create()
    {
        $equipos = Equipo::where('activo', true)->get();

        return view('partidos.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id|different:equipo_visitante_id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'lugar' => 'nullable|string|max:150',
            'puntos_local' => 'required|integer|min:0|max:65535',
            'puntos_visitante' => 'required|integer|min:0|max:65535',
            'estado' => 'required|in:programado,en_juego,finalizado,suspendido',
        ]);

        Partido::create($datos);

        return redirect()
            ->route('partidos.index')
            ->with('success', 'Partido registrado correctamente.');
    }

    public function edit(Partido $partido)
    {
        $equipos = Equipo::where('activo', true)->get();

        return view('partidos.edit', compact('partido', 'equipos'));
    }

    public function update(Request $request, Partido $partido)
    {
        $datos = $request->validate([
            'equipo_local_id' => 'required|exists:equipos,id|different:equipo_visitante_id',
            'equipo_visitante_id' => 'required|exists:equipos,id',
            'fecha' => 'required|date',
            'lugar' => 'nullable|string|max:150',
            'puntos_local' => 'required|integer|min:0|max:65535',
            'puntos_visitante' => 'required|integer|min:0|max:65535',
            'estado' => 'required|in:programado,en_juego,finalizado,suspendido',
        ]);

        $partido->update($datos);

        return redirect()
            ->route('partidos.index')
            ->with('success', 'Partido actualizado correctamente.');
    }

    public function destroy(Partido $partido)
    {
        $partido->delete();

        return redirect()
            ->route('partidos.index')
            ->with('success', 'Partido eliminado correctamente.');
    }
}
