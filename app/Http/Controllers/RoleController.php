<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        // Solo los admin pueden acceder
        $this->middleware(['role:admin']);
    }

    // Mostrar todos los usuarios y sus roles
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('roles.index', compact('users', 'roles'));
    }

    // Editar rol de usuario
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('roles.edit', compact('user', 'roles'));
    }

    // Actualizar rol
    public function update(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($id);

        // Limpiar roles anteriores y asignar nuevo
        $user->syncRoles([$request->role]);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente.');
    }
}
