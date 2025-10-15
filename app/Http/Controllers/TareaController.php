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
        $tareas = \App\Models\Tarea::with('user')->get();
        return view('tareas.index', compact('tareas'));
    }


    public function create()
    {
        $numeroTarea = Tarea::max('id') + 1;
        $users = User::all(); // Traer usuarios como clientes
        return view('tareas.create', compact('numeroTarea', 'users'));
    }

    public function store(StoreTareaRequest $request)
    {
        $tarea = new Tarea();
        $tarea->user_id = $request->input('user_id');
        $tarea->fecha_creacion = $request->input('fecha_creacion');
        $tarea->servicio = $request->input('servicio');
        $tarea->prioridad = $request->input('prioridad');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = $request->input('estado');
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
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
            ->where('nombre', 'like', "%{$query}%")
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
}
