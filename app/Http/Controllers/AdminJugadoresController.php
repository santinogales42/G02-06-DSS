<?php

namespace App\Http\Controllers;
use App\Models\Equipo;
use App\Models\Est_jugador;
use App\Models\Jugador;
use Illuminate\Http\Request;
use Artisan;
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
// AdminJugadoresController.php
public function editar($id)
    {
        $jugador = Jugador::findOrFail($id);
        $equipos = Equipo::all();  // Carga todos los equipos para el selector en la vista
        return view('editar', compact('jugador', 'equipos'));
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
// AdminJugadoresController.php
public function actualizar(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'posicion' => 'nullable|string|max:255',
        'nacionalidad' => 'nullable|string|max:255',
        'edad' => 'nullable|integer',
        'equipo_id' => 'required|exists:equipos,id',
        'foto' => 'nullable|string', // 2MB max, consider adjusting if needed
        'biografia' => 'nullable|string',
        'goles' => 'required|integer',
        'asistencias' => 'required|integer',
        'amarillas' => 'required|integer',
        'rojas' => 'required|integer',
    ]);
    try {
    $jugador = Jugador::findOrFail($id);
    $jugador->update($request->only(['nombre', 'posicion', 'nacionalidad', 'edad', 'equipo_id', 'biografia', 'foto']));

    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('public/fotos');
        $jugador->foto = basename($path);
        $jugador->save();
    }

    $estadisticas = $request->only(['goles', 'asistencias', 'amarillas', 'rojas']);
    $jugador->estadisticas()->updateOrCreate(['jugador_id' => $jugador->id], $estadisticas);

    return redirect()->route('admin.adminjugador')->with('success', 'Jugador actualizado correctamente.');
    } catch (\Exception $e) {
        return back()->withInput()->with('error', 'Error al actualizar el jugador: ' . $e->getMessage());
    }

}



public function eliminarTodos()
{
    try {
        // Eliminar primero las estadísticas asociadas
        Est_jugador::query()->delete(); // Asegúrate de que Estadistica es el modelo correcto
        // Después eliminar los jugadores
        Jugador::query()->delete();

        return response()->json(['message' => 'Todos los jugadores y estadísticas han sido eliminados con éxito'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al eliminar todos los jugadores: ' . $e->getMessage()], 500);
    }
}
public function insertarJugadores()
    {
        try {
            // Asegúrate de usar el nombre correcto del seeder
            Artisan::call('db:seed', ['--class' => 'JugadorsTableSeeder']);
            return response()->json(['message' => 'Jugadores insertados correctamente']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al insertar jugadores: ' . $e->getMessage()], 500);
        }
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'posicion' => 'nullable|string|max:255',
            'nacionalidad' => 'nullable|string|max:255',
            'edad' => 'nullable|integer',
            'equipo_id' => 'required|exists:equipos,id',
            'biografia' => 'nullable|string',
            'foto' => 'nullable|image|max:1999', // 2MB max, consider adjusting if needed
        ]);

        $jugador = Jugador::findOrFail($id);

        $jugador->nombre = $request->nombre;
        $jugador->posicion = $request->posicion;
        $jugador->nacionalidad = $request->nacionalidad;
        $jugador->edad = $request->edad;
        $jugador->equipo_id = $request->equipo_id;
        $jugador->biografia = $request->biografia;

        if ($request->hasFile('foto')) {
            // Asumimos que quieres guardar el archivo en el disco local
            $path = $request->file('foto')->store('public/fotos');
            $jugador->foto = basename($path);
        }

        $jugador->save();

        return redirect()->route('admin.adminjugador')->with('success', 'Jugador actualizado correctamente.');
    }
}

