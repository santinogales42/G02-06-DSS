<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; 
use Illuminate\Support\Facades\Validator;
use App\Rules\CustomEmailRule;
use App\Rules\ValidarNombre;
use Illuminate\Support\Facades\Mail; 
use App\Mail\WelcomeMail; 

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        Session::put('url_anterior', url()->previous());

        return view('register.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255', new ValidarNombre],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users', new CustomEmailRule],
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ];

        $messages = [
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password_confirmation.same' => 'Las contraseñas no coinciden',
            'email.custom_email' => 'El formato de correo electrónico es incorrecto',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        Session::put('userName', $user->name);

        Mail::to($user->email)->send(new WelcomeMail($user));

        return redirect()->route('home');
    }
}
