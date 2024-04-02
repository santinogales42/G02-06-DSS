<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo; // Importar el modelo Equipo



class ClasificacionController extends Controller
{
    public function index()
    {

        // Obtener todos los equipos desde la tabla de equipos
        $equipos = Equipo::orderBy('puntos', 'desc')->get();

        // Pasar los datos a la vista
        return view('clasificacion.index', ['equipos' => $equipos]);
    }
}

