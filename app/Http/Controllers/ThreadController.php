<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::all(); // Obtener todos los hilos
        return view('threads.index', compact('threads')); // Pasar los hilos a la vista
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('threads.create'); // Devolver la vista para crear un nuevo hilo
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'topic' => 'required|string|max:255',
        'content' => 'required|string',
        'image' => 'nullable|image'
    ]);

    $thread = new Thread($request->all());
    $thread->user_id = auth()->id(); // Asegúrate de que el usuario esté autenticado
    if ($request->hasFile('image') && $request->file('image')->isValid()) {
        $thread->image = $request->image->store('threads_images', 'public');
    }
    $thread->save();

    return redirect()->route('threads.index')->with('success', 'Hilo creado exitosamente!');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $thread = Thread::with(['responses' => function ($query) {
        $query->whereNull('parent_id')
              ->with(['children' => function ($query) {
                  $query->with('user'); // Carga de forma recursiva
              }, 'user']);
    }, 'user'])->findOrFail($id);

    return view('threads.show', compact('thread'));
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread = Thread::findOrFail($id);
        return view('threads.edit', compact('thread')); // Devolver la vista para editar un hilo
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'topic' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image'
        ]);

        $thread = Thread::findOrFail($id);
        $thread->update($request->all());
        return redirect()->route('threads.index'); // Redireccionar al index después de actualizar
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = Thread::findOrFail($id);
        $thread->delete();
        return redirect()->route('threads.index'); // Redireccionar al index después de eliminar
    }
}
