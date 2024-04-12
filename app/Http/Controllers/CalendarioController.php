<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partido;

class CalendarioController extends Controller
{
    public function index($jornada = 1)
    {
        $totalJornadas = 38;
        $jornadas = range(1, $totalJornadas);

        if ($jornada < 1) {
            $jornada = $totalJornadas; // Ir a la última jornada si se va más allá de la primera
        } elseif ($jornada > $totalJornadas) {
            $jornada = 1; // Ir a la primera jornada si se va más allá de la última
        }

        $jornada_actual = $jornada;

        // Obtener los partidos de la jornada seleccionada con 
        // relaciones de equipo cargadas
        $partidos = Partido::where('jornada', $jornada)
                           ->with('equipoLocal', 'equipoVisitante')
                           ->orderBy('fecha')
                           ->orderBy('hora')
                           ->get();

        return view('calendario', compact('partidos', 'jornada_actual', 'jornadas'));
    }
}
