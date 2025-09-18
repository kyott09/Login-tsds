<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Mostrar el perfil
    public function profile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    // Actualizar perfil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Actualizar datos
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
        ]);

        // Subir imagen si existe (código que me pasaste)
        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/users_profile'), $filename);
            $user->profile_image = $filename;
            $user->save();
        }

        return redirect()->back()->with('success', 'Perfil actualizado correctamente.');
    }

    // Eliminar imagen de perfil
    public function deleteProfileImage()
    {
        $user = Auth::user();

        if ($user->profile_image && file_exists(public_path('img/users_profile/' . $user->profile_image))) {
            unlink(public_path('img/users_profile/' . $user->profile_image));
        }

        $user->profile_image = null;
        $user->save();

        return redirect()->back()->with('success', 'Imagen de perfil eliminada correctamente.');
    }
}
