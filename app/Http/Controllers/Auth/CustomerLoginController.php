<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerLoginController extends Controller
{
    // Mostrar formulario de login (si ya tienes ruta/plantilla distinta, no es necesario)
    public function showLoginForm()
    {
        return view('auth.logincustomer');
    }

    // Procesar intento de login con validaciones y mensajes específicos
    public function login(Request $request)
    {
        // Reglas básicas de validación
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Buscar usuario por email
        $user = User::where('email', $email)->first();

        if (! $user) {
            // Usuario no existe -> error en campo email
            return back()
                ->withErrors(['email' => 'No se encontró un usuario con ese email.'])
                ->withInput($request->only('email'));
        }

        // Verificar contraseña
        if (! Hash::check($password, $user->password)) {
            return back()
                ->withErrors(['password' => 'Contraseña incorrecta.'])
                ->withInput($request->only('email'));
        }

        // Opcional: si sólo clientes pueden iniciar aquí, verificar role (si aplica)
        // if (! $user->hasRole('cliente')) {
        //     return back()->withErrors(['email' => 'Cuenta no autorizada para login de cliente.'])->withInput($request->only('email'));
        // }

        // Intentar login (login directo porque ya verificamos credenciales)
        Auth::login($user, $request->filled('remember'));

        return redirect()->intended('/home');
    }
}
