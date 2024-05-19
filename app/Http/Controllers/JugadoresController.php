<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use Illuminate\Http\Request;
use App\ServiceLayer\OrderServices;

class JugadoresController extends Controller
{
    public function index(Request $request)
    {
        try {
            $jugadores = OrderServices::getPlayersWithStatisticsAndTeams($request);

            if ($request->ajax()) {
                return response()->json([
                    'data' => $jugadores->items(),
                    'links' => $jugadores->appends($request->all())->links()->toHtml(),
                ]);
            }

            return view('jugadores.index', compact('jugadores'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener jugadores: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $jugador = Jugador::with('estadisticas', 'equipo')->findOrFail($id);
            return view('jugadores.show', compact('jugador'));
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el jugador: ' . $e->getMessage()], 500);
        }
    }
}
