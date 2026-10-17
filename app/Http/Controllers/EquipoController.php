<?php
namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::latest()->get();
        return view('equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'entrenador' => 'nullable|string|max:100',
        ]);

        Equipo::create($datos);

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo registrado correctamente.');
    }

    public function edit(Equipo $equipo)
    {
        return view('equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $datos = $request->validate([
            'nombre' => 'required|string|max:100',
            'ciudad' => 'nullable|string|max:100',
            'entrenador' => 'nullable|string|max:100',
        ]);

        $equipo->update($datos);

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo actualizado correctamente.');
    }

    public function destroy(Equipo $equipo)
    {
        $equipo->delete();

        return redirect()
            ->route('equipos.index')
            ->with('success', 'Equipo eliminado correctamente.');
    }
}

