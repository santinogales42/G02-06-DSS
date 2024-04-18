<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; // Importa la clase Session
use Illuminate\Support\Facades\Validator;

class AdminUsuariosController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('salida');
        $ordenNombre = $request->get('ordenNombre', 'asc');
        $usuariosQuery = User::query(); // Obtener la consulta base
    
        // Verificar si el query contiene el símbolo '@'
        if ($query !== null && strpos($query, '@') !== false) {
            $usuariosQuery->where('email', 'like', '%' . $query . '%');
        } else {
            // Si no contiene '@', buscar por nombre
            $usuariosQuery->where('name', 'like', $query . '%');
        }
    
        // Aplicar la ordenación después del filtro de búsqueda
        $usuarios = $usuariosQuery->orderBy('name', $ordenNombre)->get();
    
        return view('admin.usuarios.index', compact('usuarios'));
    }
    
    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario de registro
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Verifica que la contraseña tenga al menos 8 caracteres
            'password_confirmation' => 'required|string|same:password', // Verifica que la confirmación de la contraseña coincida con la contraseña
        ]);

        // Crear un nuevo usuario en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ]);

        Session::flash('success', 'Usuario creado exitosamente.');
        return redirect()->route('admin.usuarios.index');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // Actualizar los campos del usuario con los datos del formulario
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->save();

        // Redirigir a la página de lista de usuarios con un mensaje de éxito
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $usuarioABorrar = User::findOrFail($id);
        $usuarioABorrar->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
