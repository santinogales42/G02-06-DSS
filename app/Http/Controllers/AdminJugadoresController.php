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
}
