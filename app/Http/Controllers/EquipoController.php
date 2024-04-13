<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;

class EquipoController extends Controller
{
    public function index(Request $request)
    {
        $equipos = Equipo::query();

        if ($request->has('order')) {
            $order = $request->order;
            if (in_array($order, ['puntos', 'goles_favor', 'goles_contra'])) {
                $equipos->orderBy($order, 'desc');
            }
        } else {
            $equipos->orderBy('puntos', 'desc');
        }

        $equipos = $equipos->get();

        return view('clasificacion.index', compact('equipos'));
    }


    public function show(Equipo $equipo)
    {
        return view('equipos.show', compact('equipo'));
    }

}

