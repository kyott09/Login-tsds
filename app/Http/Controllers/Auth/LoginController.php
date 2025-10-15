<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Middleware: solo invitados pueden acceder a login, excepto logout
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login'); // Ajusta la ruta si tu vista está en otro folder
    }

    // Procesar login
    public function login(Request $request)
    {
        // Validación
        $credentials = $request->validate([
            'user' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Intentar autenticar
        if (Auth::attempt(['user' => $credentials['user'], 'password' => $credentials['password']], $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/home'); // o dashboard
        }

        return back()->withErrors([
            'user' => 'Credenciales incorrectas',
        ])->withInput();
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Redirige al home
    }
}