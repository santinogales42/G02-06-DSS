<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; // Importa la clase Session

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Guarda la URL anterior en la sesión
        Session::put('url_anterior', url()->previous());

        return view('register.register');
    }

    public function register(Request $request)
    {
        // Validar los datos del formulario de registro
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // Verifica que la contraseña tenga al menos 8 caracteres
            'password_confirmation' => 'required|string|same:password', // Verifica que la confirmación de la contraseña coincida con la contraseña
        ], [
            'password.min' => 'La contraseña debe tener al menos 8 dígitos', // Personaliza el mensaje de error para la validación de longitud mínima de contraseña
            'password_confirmation.same' => 'Las contraseñas introducidas no coinciden', // Personaliza el mensaje de error para la validación de coincidencia de contraseña
        ]);
        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->withInput()->withErrors(['password_confirmation' => 'Las contraseñas no coinciden']);
        }

        // Crear un nuevo usuario en la base de datos
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' =>  Hash::make($validatedData['password']),
        ]);

        Auth::login($user);
        Session::put('userName', Auth::user()->name);
        return redirect()->route('home');
    }
}
