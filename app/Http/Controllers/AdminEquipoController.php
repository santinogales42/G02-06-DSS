<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class AdminEquipoController extends Controller
{
    public function index()
    {
        $equipos = Equipo::all(); // Obtener todos los equipos
        return view('admin.equipos.index', compact('equipos'));
    }

    public function create()
    {
        return view('admin.equipos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        try {
            $equipo = Equipo::create($validated);
            return redirect()->route('admin.equipos.index')->with('success', 'Equipo creado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al crear el equipo: ' . $e->getMessage());
        }
    }

    public function show(Equipo $equipo)
    {
        return view('admin.equipos.show', compact('equipo'));
    }

    public function edit(Equipo $equipo)
    {
        return view('admin.equipos.edit', compact('equipo'));
    }

    public function update(Request $request, Equipo $equipo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            // Aquí puedes añadir más campos según el modelo de datos
        ]);

        try {
            $equipo->update($validated);
            return redirect()->route('admin.equipos.index')->with('success', 'Equipo actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al actualizar el equipo: ' . $e->getMessage());
        }
    }

    public function destroy(Equipo $equipo)
    {
        try {
            $equipo->delete();
            return redirect()->route('admin.equipos.index')->with('success', 'Equipo eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->withErrors('Error al eliminar el equipo: ' . $e->getMessage());
        }
    }
}
