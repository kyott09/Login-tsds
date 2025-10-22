<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\User;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;
use Illuminate\Http\Request;
use PDF;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::with('user')->get();
        $usuarios = User::orderBy('name')->get(); // 🔹 Agregado
        return view('tareas.index', compact('tareas', 'usuarios')); // 🔹 Pasamos la variable a la vista
    }



    public function create()
    {
        $numeroTarea = Tarea::max('id') + 1;
        $users = User::all(); // Traer usuarios como clientes
        return view('tareas.create', compact('numeroTarea', 'users'));
    }

    public function store(StoreTareaRequest $request)
    {
        $user = auth()->user();

        $tarea = new Tarea();
        $tarea->user_id = $user->id;
        $tarea->fecha_creacion = now();
        $tarea->servicio = $request->input('servicio');
        $tarea->prioridad = $user->prioridad; // prioridad del usuario
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = 'En proceso'; // por defecto
        $tarea->save();

        //  Redirección según rol
        if ($user->hasRole('cliente') || $user->hasRole('premium')) {
            return redirect()->route('tareas.mis_tareas')
                            ->with('success', 'Tarea solicitada correctamente.');
        } else {
            // Empleado o admin
            return redirect()->route('tareas.index')
                            ->with('success', 'Tarea registrada correctamente.');
        }
    }



    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        $users = \App\Models\User::all();
        return view('tareas.edit', compact('tarea','users'));
    }


    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        $tarea->user_id = $request->input('user_id');
        $tarea->fecha_creacion = $request->input('fecha_creacion');
        $tarea->servicio = $request->input('servicio');
        $tarea->prioridad = $request->input('prioridad');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = $request->input('estado');
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }

    // Método para la búsqueda de tareas
    public function busqueda(Request $request)
    {
        $query = $request->input('query');
        $tareas = Tarea::with('user')
            ->where('servicio', 'like', "%{$query}%")
            ->orWhere('descripcion', 'like', "%{$query}%")
            ->get();

        return view('tareas.busqueda', compact('tareas', 'query'));
    }

    // Método para exportar tareas a PDF
    public function pdf()
    {
        $tareas = Tarea::with('user')->get();
        $pdf = \PDF::loadView('tareas.pdf', compact('tareas'));
        return $pdf->download('tareas.pdf');
    }

        // Listado de tareas solo del cliente logueado
    public function misTareas()
    {
        $user = auth()->user();
        $tareas = Tarea::where('user_id', $user->id)->orderBy('fecha_creacion', 'desc')->get();

        return view('tareas.mis_tareas', compact('tareas'));
    }

}

