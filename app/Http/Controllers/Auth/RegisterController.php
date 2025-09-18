<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Middleware: solo invitados
    public function __construct()
    {
        $this->middleware('guest');
    }

    // Mostrar formulario de registro
    public function showRegistrationForm()
    {
        return view('auth.register'); // Ajusta según tu carpeta
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users'],
            'user' => ['required','string','max:255','unique:users'], // nombre de usuario único
            'password' => ['required','string','min:8','confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user' => $request->user,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('/home');
    }
}
