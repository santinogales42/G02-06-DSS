<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
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

        Carbon::setLocale('es');

        foreach ($partidos as $partido) {
            $fecha = Carbon::createFromFormat('Y-m-d', $partido->fecha);

            $hora = Carbon::createFromFormat('H:i:s', $partido->hora);
            $partido->hora_nueva = $hora->format('H:i');
            
            if ($fecha->isToday()) {
                $partido->fecha_nueva = 'Hoy';
            } elseif ($fecha->isTomorrow()) {
                $partido->fecha_nueva = 'Mañana';
            } else {
                $partido->fecha_nueva = $fecha->isoFormat('ddd D MMM YYYY');
            }
        }

        return view('calendario', compact('partidos', 'jornada_actual', 'jornadas'));
    }
}
