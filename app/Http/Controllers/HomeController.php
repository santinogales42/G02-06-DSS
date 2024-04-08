<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Verifica si el usuario está logueado y obtiene su nombre
        $isUserLoggedIn = Auth::check();
        $userName = $isUserLoggedIn ? Auth::user()->nombre : null;

        // Retorna la vista y pasa las variables 'isUserLoggedIn' y 'userName'
        return view('layout', ['isUserLoggedIn' => $isUserLoggedIn, 'userName' => $userName]);
    }
}

