<?php

namespace App\Http\Controllers;
use App\Models\Jugador;
use Illuminate\Http\Request;

class JugadoresController extends Controller
{
    public function index(Request $request)
{
    $query = Jugador::with(['estadisticas', 'equipo']); // Precargar estadísticas y equipo

    if ($request->has('search')) {
        $search = $request->search;
        $query->where(function($query) use ($search) {
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('posicion', 'LIKE', "%{$search}%");
        });
    }

    $orderField = $request->input('orderField', 'nombre'); // Campo por defecto para ordenar
    $orderDirection = $request->input('orderDirection', 'asc'); // Dirección de ordenación por defecto

    if(in_array($orderField, ['nombre', 'posicion', 'edad'])) {
        $query->orderBy($orderField, $orderDirection);
    } // Si ordenamos por un campo de estadísticas
    if (in_array($orderField, ['goles', 'asistencias', 'amarillas', 'rojas'])) {
        $query->leftJoin('est_jugadors', 'jugadors.id', '=', 'est_jugadors.jugador_id')
              ->select('jugadors.*', 'est_jugadors.goles', 'est_jugadors.asistencias', 'est_jugadors.amarillas', 'est_jugadors.rojas')
              ->orderBy('est_jugadors.' . $orderField, $orderDirection);
    }
    

    $jugadores = $query->paginate(10);

    if ($request->ajax()) {
        return response()->json([
            'data' => $jugadores->items(),
            'links' => $jugadores->appends($request->all())->links()->toHtml(),
        ]);
    }

    return view('jugadores.index', compact('jugadores'));
}

    public function show($id)
    {
        $jugador = Jugador::with('estadisticas', 'equipo')->findOrFail($id);
        return view('jugadores.show', compact('jugador'));
    }

}

