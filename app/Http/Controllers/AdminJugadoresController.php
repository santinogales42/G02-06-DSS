<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;

class AdminJugadoresController extends Controller
{
    public function index(Request $request)
    {
        $query = Jugador::query();
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%");
        }
    
        $jugadores = $query->paginate(10); // Paginación
    
        if ($request->ajax()) {
            // Preparando el HTML de los enlaces de paginación
            $links = $jugadores->appends(['search' => $search])->links()->toHtml();

            // Preparando los datos para enviar
            return response()->json([
                'data' => $jugadores->items(), // Datos de jugadores
                'links' => $links, // HTML de los enlaces de paginación
            ]);
        }
    
        return view('admin.adminjugador', compact('jugadores'));
    }
    public function eliminar(Request $request, $id)
{
    try {
        $jugador = Jugador::findOrFail($id);
        $jugador->delete();

        return response()->json(['message' => 'Jugador eliminado con éxito'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al eliminar jugador'], 500);
    }
}
public function eliminarMasa(Request $request)
{
    $ids = $request->ids;

    try {
        Jugador::whereIn('id', $ids)->delete();

        return response()->json(['message' => 'Jugadores eliminados con éxito'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al eliminar jugadores: ' . $e->getMessage()], 500);
    }
}
public function crear(Request $request)
{
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'posicion' => 'string|max:255|nullable',
        'nacionalidad' => 'string|max:255|nullable',
        'edad' => 'integer|nullable',
        'equipo_id' => 'required|exists:equipos,id',
        'foto' => 'string|nullable',
        'biografia' => 'string|nullable',
    ]);

    try {
        $jugador = Jugador::create($validatedData);
        return response()->json(['message' => 'Jugador creado con éxito', 'jugador' => $jugador], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al crear jugador: ' . $e->getMessage()], 500);
    }
}
public function getDatos($id)
{
    $jugador = Jugador::findOrFail($id);
    return response()->json($jugador);
}

public function actualizar(Request $request, $id)
{
    $jugador = Jugador::findOrFail($id);
    $validatedData = $request->validate([
        'nombre' => 'required|string|max:255',
        'posicion' => 'string|max:255|nullable',
        'nacionalidad' => 'string|max:255|nullable',
        'edad' => 'integer|nullable',
        'equipo_id' => 'required|exists:equipos,id',
        'foto' => 'string|nullable',
        'biografia' => 'string|nullable',
    ]);

    $jugador->update($validatedData);
    return response()->json(['message' => 'Jugador actualizado con éxito']);
}


}
