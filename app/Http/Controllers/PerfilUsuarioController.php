<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


class PerfilUsuarioController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('perfilUsuario.index', compact('user'));
    }

    public function edit()
    {
        $user = User::findOrFail(auth()->id());
        return view('perfilUsuario.edit', compact('user'));
    }

    // Modifica tu controlador PerfilUsuarioController@update
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validación de campos
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|same:password',
        ]);

        // Asigna los valores al modelo User si se proporcionan
        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email')) {
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }

        // Guarda el usuario en la base de datos
        $user->save();

        // Redirecciona de vuelta con mensaje de éxito o errores de validación
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return redirect()->route('perfilUsuario.index')->with('success', 'Perfil actualizado correctamente');
    }
}
