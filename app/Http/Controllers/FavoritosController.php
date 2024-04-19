<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Equipo;

class FavoritosController extends Controller
{
    public function index()
    {
        // Verificar si el usuario está autenticado
        if (auth()->check()) {
            // Obtener el usuario actualmente autenticado
            $user = auth()->user();

            // Obtener los equipos favoritos del usuario
            $equiposFavoritos = $user->equipos()->get();

            // Renderizar la vista con los equipos favoritos
            return view('favoritos.index', compact('equiposFavoritos'));
        } else {
            // Si el usuario no está autenticado, mostrar un mensaje de advertencia
            return view('favoritos.index')->with('warning', 'Debes registrarte/iniciar sesión para ver tus favoritos.');
        }
    }

    public function editar($nombreEquipo)
    {
        // Renderizar la vista de edición con el nombre del equipo
        return view('favoritos.edit', ['nombreEquipo' => $nombreEquipo]);
    }

    public function delete($nombreEquipo)
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();

        // Buscar el equipo por su nombre
        $equipo = Equipo::where('nombre', $nombreEquipo)->firstOrFail();

        // Eliminar el equipo de los favoritos del usuario
        $user->equipos()->detach($equipo->id);

        // Redireccionar a la página de favoritos
        return redirect()->route('favoritos.index')->with('success', 'Equipo eliminado de tus favoritos correctamente.');
    }
}
