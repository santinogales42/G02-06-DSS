<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Partido;
use App\Models\Est_partido;
use App\Models\Equipo;

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

        $equipos = Equipo::all();

        return view('calendario.index', compact('partidos', 'jornada_actual', 'jornadas', 'equipos'));
    }

    public function show($equipo)
    {
        // $equipo aquí es el ID del equipo seleccionado
        $equipo_id = $equipo;

        // Obtener información del equipo seleccionado
        $equipo = Equipo::findOrFail($equipo_id);

        // Obtener partidos donde el equipo es local o visitante
        $partidos = Partido::where('equipo_local_id', $equipo_id)
            ->orWhere('equipo_visitante_id', $equipo_id)
            ->orderBy('jornada')
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
        
        $equipos = Equipo::all();

        return view('calendario.show', compact('equipos', 'partidos'));
    }

    public function showEstadisticas($id)
    {
        Carbon::setLocale('es');

        $partido = Partido::findOrFail($id);

        $fecha = Carbon::createFromFormat('Y-m-d', $partido->fecha);
        $partido->fecha_nueva = $fecha->isoFormat('D [de] MMMM [de] YYYY[, ]');

        $hora = Carbon::createFromFormat('H:i:s', $partido->hora);
        $partido->hora_nueva = $hora->format('H:i');

        $estPartido = Est_partido::where('partido_id', $id)->first();

        return view('partidos', compact('partido', 'estPartido'));
    }
}
