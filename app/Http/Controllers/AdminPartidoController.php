<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Equipo;
use App\Models\Partido;

class AdminPartidoController extends Controller
{
    public function index()
    {
        $partidos = Partido::all();
        $equipos = Equipo::all();
        return view('admin.partidos.index', compact('partidos', 'equipos'));
    }
    
    public function create()
    {
        $equipos = Equipo::all();
        return view('admin.partidos.create', compact('equipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'estadio' => 'required',
            'equipo_local' => 'required|different:equipo_visitante',
            'resultado' => 'nullable',
            'equipo_visitante' => 'required|different:equipo_local',
            'jornada' => 'required|integer|min:1|max:38',
        ]);

        $partido = new Partido();
        $partido->fecha = $request->input('fecha');
        $partido->hora =  $request->hora;
        $partido->estadio = $request->estadio;
        $partido->equipo_local_id = $request->equipo_local;
        $partido->resultado = $request->resultado;
        $partido->equipo_visitante_id = $request->equipo_visitante;
        $partido->jornada = $request->jornada;
        $partido->save();

        return redirect()->route('admin.partidos.index')->with('success', 'Partido creado exitosamente.');
    }

    public function edit()
    {
        $equipos = Equipo::all();
        return view('admin.partidos.edit', compact('equipos'));
    }



    public function update(Request $request, $partido)
    {
        $validator = Validator::make($request->all(), [
            'fecha' => 'required|date',
            'hora' => ['required', 'regex:/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/'],
            'estadio' => 'required',
            'equipo_local' => 'required|different:equipo_visitante',
            'resultado' => 'nullable|regex:/^\d+-\d+$/',
            'equipo_visitante' => 'required|different:equipo_local',
            'jornada' => 'required|integer|min:1|max:38',
        ], [
            'hora.regex' => 'El formato de la hora es inválido. Utiliza el formato HH:mm:ss (24 horas).',
            'resultado.regex' => 'El campo resultado debe tener el formato adecuado (número-número).',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Actualizar los datos del partido
        $partido->fecha = $request->input('fecha');
        $partido->hora = $request->hora;
        $partido->estadio = $request->estadio;
        $partido->resultado = $request->resultado;
        $partido->jornada = $request->jornada;
        $partido->equipo_local_id = $request->equipo_local;
        $partido->equipo_visitante_id = $request->equipo_visitante;
        $partido->save();
    
        return redirect()->route('admin.partidos.index')->with('success', 'Partido actualizado correctamente.');
    }

    public function delete($id)
    {
        $partido = Partido::findOrFail($id);
        return redirect()->route('admin.partidos.index')->with('success', 'Partido eliminado exitosamente.');
    }

    public function search(Request $request)
    {
        $local = $request->input('equipo_local');
        $visitante = $request->input('equipo_visitante');

        $partido = Partido::where('equipo_local_id', $local)
                        ->where('equipo_visitante_id', $visitante)
                        ->first();

        if (!$partido) {
            return redirect()->route('admin.partidos.index')->with('error', 'No se encontró ningún partido con los equipos seleccionados.');
        }
        $equipos = Equipo::all();
        return view('admin.partidos.edit', compact('partido', 'equipos'));
    }
}
