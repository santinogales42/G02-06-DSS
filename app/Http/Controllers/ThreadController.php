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
    $threads = Thread::with('user')->get(); // Carga anticipada de usuarios
    return view('threads.index', compact('threads'));
}
public function filterThreadsByUser(User $user)
{
    $threads = $user->threads; // Asume que tienes una relación 'threads' en el modelo User
    return view('threads.thread_list', compact('threads')); // Reutiliza la vista de lista de hilos para mostrar los hilos filtrados
}

public function toggleThreads(Request $request)
{
    if ($request->query('showMy', 'false') === 'true') {
        $threads = Thread::where('user_id', auth()->id())->get();
    } else {
        $threads = Thread::all();
    }
    return view('threads.thread_list', ['threads' => $threads]);
}

public function threadsByUser()
{
    \Log::debug("Fetching users with threads.");
    try {
        $users = User::has('threads')->with('threads')->get();
        return view('threads.users_list', ['users' => $users]);
    } catch (\Exception $e) {
        \Log::error("Error retrieving users with threads: " . $e->getMessage());
        throw $e; // Re-lanza la excepción para que se pueda ver en el log
    }
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
    public function destroy(Thread $thread)
{
    $this->authorize('delete', $thread);

    $thread->delete();

    return redirect()->route('threads.index')
        ->with('success', 'Hilo eliminado correctamente.');
}

}
