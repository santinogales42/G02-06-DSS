<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use App\Models\Equipo;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    public function index()
    {
        return view('noticias');
    }

    public function getDatos($id)
    {
        $noticia = Noticia::findOrFail($id);
        return response()->json($noticia);
    }
    public function getEquipoName($id)
    {
        // Busca el equipo por su ID
        $equipo = Equipo::find($id);

        // Verifica si se encontró el equipo
        if ($equipo) {
            // Devuelve el nombre del equipo en formato JSON
            return response()->json(['nombre' => $equipo->nombre]);
        } else {
            // Devuelve un mensaje de error si el equipo no se encuentra
            return response()->json(['error' => 'Equipo no encontrado'], 404);
        }
    }
}