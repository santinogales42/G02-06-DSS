<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminNoticiasController extends Controller
{
    /**
     * Muestra la lista de noticias.
     */
    public function index(Request $request)
    {
        $query = Noticia::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('titulo', 'LIKE', "%{$search}%")
                  ->orWhere('contenido', 'LIKE', "%{$search}%");
        }

        $noticias = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'data' => $noticias->items(),
                'links' => $noticias->appends(['search' => $search])->links()->toHtml(),
            ]);
        }

        return view('admin.adminnoticias', compact('noticias'));
    }

    /**
     * Guarda una nueva noticia.
     */
    public function crear(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'fecha' => 'required|date',
            'autor' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación', 'errors' => $validator->errors()], 422);
        }

        $noticia = Noticia::create($validator->validated());

        return response()->json(['message' => 'Noticia creada con éxito', 'noticia' => $noticia], 201);
    }

    /**
     * Muestra los datos de una noticia para editar.
     */
    public function getDatos($id)
    {
        $noticia = Noticia::findOrFail($id);
        return response()->json($noticia);
    }

    /**
     * Actualiza una noticia específica.
     */
    public function actualizar(Request $request, $id)
    {
        $noticia = Noticia::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'fecha' => 'required|date',
            'autor' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Error en la validación', 'errors' => $validator->errors()], 422);
        }

        $noticia->update($validator->validated());

        return response()->json(['message' => 'Noticia actualizada con éxito', 'noticia' => $noticia], 200);
    }

    /**
     * Elimina una noticia específica.
     */
    public function eliminar($id)
    {
        $noticia = Noticia::findOrFail($id);
        $noticia->delete();
        return response()->json(['message' => 'Noticia eliminada con éxito'], 200);
    }

    /**
     * Elimina todas las noticias.
     */
    public function eliminarTodas()
    {
        Noticia::query()->delete();
        return response()->json(['message' => 'Todas las noticias han sido eliminadas con éxito'], 200);
    }
}
