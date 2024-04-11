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
	
        // Agregar la lógica de ordenación basada en los parámetros orderField y orderDirection
        $orderField = $request->input('orderField', 'nombre'); // Campo por defecto para ordenar
        $orderDirection = $request->input('orderDirection', 'asc'); // Dirección de ordenación por defecto

        // Asumiendo que los campos de ordenación corresponden directamente a los de la tabla 'jugadores' o a los atributos calculados en el modelo.
        // Si necesitas ordenar por atributos en las relaciones, como 'estadisticas.goles', necesitarás lógica adicional para manejar esos casos.
        if(in_array($orderField, ['nombre', 'posicion', 'edad']) || $orderField == 'goles' || $orderField == 'asistencias' || $orderField == 'amarillas' || $orderField == 'rojas'){
            if($orderField == 'goles' || $orderField == 'asistencias' || $orderField == 'amarillas' || $orderField == 'rojas'){
                // Ordenar basado en campos de la relación 'estadisticas'. Necesitarás ajustar esto basado en cómo está estructurada tu base de datos.
                $query->join('est_jugadors', 'jugadors.id', '=', 'est_jugadors.jugador_id')
      ->orderBy('est_jugadors.' . $orderField, $orderDirection);

            }else{
                // Ordenar basado en campos del modelo 'Jugador'
                $query->orderBy($orderField, $orderDirection);
            }
        }

        $jugadores = $query->get();

        if ($request->ajax()) {
            return response()->json($jugadores);
        }

        return view('jugadores.index', compact('jugadores'));
    }
    public function show($id)
    {
        $jugador = Jugador::with('estadisticas', 'equipo')->findOrFail($id);
        return view('jugadores.show', compact('jugador'));
    }

}

