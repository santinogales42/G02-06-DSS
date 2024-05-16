<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\ServiceLayer\OrderServices;

class AdminJugadoresController extends Controller
{
    public function index(Request $request)
    {
        $equipos = Equipo::all();
        $query = Jugador::query();
    
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nombre', 'LIKE', "%{$search}%");
        }
    
        $jugadores = $query->paginate(10); // Paginación
    
        if ($request->ajax()) {
            $links = $jugadores->appends(['search' => $search])->links()->toHtml();
            return response()->json([
                'data' => $jugadores->items(),
                'links' => $links,
            ]);
        }
    
        return view('admin.adminjugador', compact('jugadores','equipos'));
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

    public function editar($id)
    {
        $equipos = Equipo::all(); // Obtiene todos los equipos
        $jugador = Jugador::findOrFail($id);
        return view('editar', compact('jugador', 'equipos'));
    }

    public function crear(Request $request)
    {
        Log::info($request->all());
    
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
            $jugador = OrderServices::createPlayer($validatedData);
            return response()->json([
                'message' => 'Jugador creado con éxito',
                'jugador' => $jugador,
            ], 200);
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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'posicion' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
            'edad' => 'nullable|integer',
            'equipo_id' => 'required|exists:equipos,id',
            'foto' => 'nullable|string',
            'biografia' => 'nullable|string',
            'goles' => 'required|integer',
            'asistencias' => 'required|integer',
            'amarillas' => 'required|integer',
            'rojas' => 'required|integer',
        ]);

        $validatedData = $request->only(['nombre', 'posicion', 'nacionalidad', 'edad', 'equipo_id', 'biografia']);
        $estadisticas = $request->only(['goles', 'asistencias', 'amarillas', 'rojas']);
        $foto = $request->file('foto');

        try {
            $jugador = OrderServices::updatePlayer($id, $validatedData, $estadisticas, $foto);
            return redirect()->route('admin.adminjugador')->with('success', 'Jugador actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error al actualizar el jugador: ' . $e->getMessage());
        }
    }

    public function eliminarTodos()
    {
        try {
            OrderServices::deleteAllPlayers();
            return response()->json(['message' => 'Todos los jugadores y estadísticas han sido eliminados con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar todos los jugadores: ' . $e->getMessage()], 500);
        }
    }

    public function insertarJugadores()
    {
        try {
            Artisan::call('db:seed', ['--class' => 'JugadorsTableSeeder']);
            return response()->json(['message' => 'Jugadores insertados correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al insertar jugadores: ' . $e->getMessage()], 500);
        }
    }
}
