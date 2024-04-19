<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class AdminEquipoController extends Controller
{
    public function index(Request $request)
    {
        $query = Equipo::query();
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%");
        }
    
        $equipos = $query->paginate(10); // Paginación
    
        if ($request->ajax()) {
            $links = $equipos->appends(['search' => $search])->links()->toHtml();
            return response()->json([
                'data' => $equipos->items(),
                'links' => $links,
            ]);
        }
    
        return view('admin.adminequipo', compact('equipos'));
    }

    public function crear(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:75',
            'liga_id' => 'nullable|exists:ligas,id',
            'ganados' => 'nullable|integer',
            'empatados' => 'nullable|integer',
            'perdidos' => 'nullable|integer',
            'goles_favor' => 'nullable|integer',
            'goles_contra' => 'nullable|integer',
            'puntos' => 'nullable|integer',
            'partidos_jugados' => 'nullable|integer'
        ]);

        try {
            $equipo = Equipo::create($validatedData);
            return response()->json(['message' => 'Equipo creado con éxito', 'equipo' => $equipo], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear equipo: ' . $e->getMessage()], 500);
        }
    }


    public function eliminar(Request $request, $id)
    {
        try {
            $equipo = Equipo::findOrFail($id);
            $equipo->delete();
            return response()->json(['message' => 'Equipo eliminado con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar equipo'], 500);
        }
    }

    public function actualizar(Request $request, $id)
    {
        $equipo = Equipo::findOrFail($id);
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:75',
        ]);

        $equipo->update($validatedData);
        return response()->json(['message' => 'Equipo actualizado con éxito']);
    }

    public function eliminarMasa(Request $request)
    {
        $ids = $request->ids;
        try {
            Equipo::whereIn('id', $ids)->delete();
            return response()->json(['message' => 'Equipos eliminados con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar equipos: ' . $e->getMessage()], 500);
        }
    }

    public function eliminarTodos()
    {
        try {
            Equipo::query()->delete();
            return response()->json(['message' => 'Todos los equipos han sido eliminados con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar todos los equipos: ' . $e->getMessage()], 500);
        }
    }

    public function insertarEquipos()
    {
        try {
            Artisan::call('db:seed', ['--class' => 'EquiposTableSeeder']);
            return response()->json(['message' => 'Equipos insertados correctamente']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al insertar equipos: ' . $e->getMessage()], 500);
        }
    }

}
