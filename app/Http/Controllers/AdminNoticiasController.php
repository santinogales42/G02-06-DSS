<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class AdminNoticiasController extends Controller
{
    public function index(Request $request)
    {
        $query = Noticia::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('titulo', 'LIKE', "%{$search}%");
        }

        $noticias = $query->paginate(10);

        return view('admin.adminnoticias', compact('noticias'));
    }

    public function crear(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'autor' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
            'link_de_la_web' => 'nullable|string|max:255',
            'enlace_de_la_foto' => 'nullable|string|max:255',
            'equipo_id' => 'nullable|exists:equipos,id',
        ]);
        
        try{
            $noticia = Noticia::create($validatedData);
            return response()->json(['message' => 'Noticia creada con éxito', 'noticia' => $noticia], 200);
        
        }
        catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear noticia: ' . $e->getMessage()], 500);
        }
 
    }

    public function eliminarTodas()
    {
        try {
            Noticia::query()->delete();

            return response()->json(['message' => 'Todas las noticias han sido eliminadas con éxito'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar todas las noticias: ' . $e->getMessage()], 500);
        }
    }

    public function getDatos($id)
    {
        // Utiliza el ID para obtener los datos de la noticia
        $noticia = Noticia::findorFail($id);

        // Devuelve los datos de la noticia (por ejemplo, en formato JSON)
        return response()->json($noticia);
    }
}