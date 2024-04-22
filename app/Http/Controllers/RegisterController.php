<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; // Importa la clase Session
use Illuminate\Support\Facades\Validator;
use App\Rules\CustomEmailRule;
use App\Rules\ValidarNombre;

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
        // Define las reglas de validación
        $rules = [
            'name' => ['required', 'string', 'max:255', new ValidarNombre],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new CustomEmailRule],
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ];

        // Define los mensajes de error personalizados
        $messages = [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password_confirmation.same' => 'Las contraseñas no coinciden',
            'email.custom_email' => 'El formato de correo electrónico es incorrecto',
        ];

        // Aplica las reglas de validación y los mensajes personalizados
        $validator = Validator::make($request->all(), $rules, $messages);

        // Verifica si hay errores de validación
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Crear un nuevo usuario en la base de datos
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Inicia sesión con el nuevo usuario
        Auth::login($user);

        // Guarda el nombre del usuario en la sesión
        Session::put('userName', $user->name);

        // Redirige a la página de inicio
        return redirect()->route('home');
    }
}
