<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use App\Models\Noticia;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Obtener las últimas noticias
        $noticias = Noticia::latest()->take(5)->get(); // Asume que tienes una tabla/modelo de noticias

        // Obtener la clasificación de equipos
        $equipos = Equipo::orderBy('puntos', 'desc')->get(); // Ordena los equipos por puntos de forma descendente

        // Pasar los datos a la vista
        return view('home', compact('noticias', 'equipos'));
    }
}
