<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia; // Corregido para que coincida con el nombre de tu modelo
use App\Models\Equipo;
use App\Models\Partido;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $partidosHoy = Partido::whereDate('fecha', $today)->get();

        $news = Noticia::all();
        
        $equipos = Equipo::orderBy('puntos', 'desc')->get();
        $classification = Equipo::orderBy('puntos', 'desc')->get();

        return view('home', [
            'news' => $news,
            'classification' => $classification,
            'equipos' => $equipos,
            'partidosHoy' => $partidosHoy
        ]);
    }
}

