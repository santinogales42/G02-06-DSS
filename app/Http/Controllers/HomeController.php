<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticia; // Corregido para que coincida con el nombre de tu modelo
use App\Models\Equipo; // Asumiendo que también tienes un modelo Team

class HomeController extends Controller
{
    public function index()
    {
        $news = Noticia::all(); // Utiliza el modelo Noticia correctamente
        $classification = Equipo::orderBy('puntos', 'desc')->get(); // Suponiendo un modelo Team

        return view('home', [
            'news' => $news,
            'classification' => $classification
        ]);
    }
}

