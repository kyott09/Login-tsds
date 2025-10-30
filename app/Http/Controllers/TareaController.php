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
        $usuarios = User::role('cliente')->orderBy('name')->get();
        return view('tareas.index', compact('tareas','usuarios'));
    }

    public function create()
    {
        $numeroTarea = Tarea::max('id') + 1;
        $users = User::role('cliente')->orderBy('name')->get();
        return view('tareas.create', compact('numeroTarea', 'users'));
    }

    public function store(StoreTareaRequest $request)
    {
        $user = auth()->user();

        $tarea = new Tarea();
        $tarea->user_id = $request->input('user_id');
        $tarea->fecha_creacion = $request->input('fecha_creacion') ?? now();
        $tarea->servicio = $request->input('servicio');
        $tarea->prioridad = $request->input('prioridad');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = $request->input('estado') ?? 'En proceso';
        $tarea->save();

        if ($user->hasRole('cliente') || $user->hasRole('premium')) {
            return redirect()->route('tareas.misTareas')
                             ->with('success', 'Tarea solicitada correctamente.');
        } else {
            return redirect()->route('tareas.index')
                             ->with('success', 'Tarea registrada correctamente.');
        }
    }

    public function edit(Tarea $tarea)
    {
        $usuarios = User::role('cliente')->orderBy('name')->get();
        return view('tareas.edit', compact('tarea','usuarios'));
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

    public function busqueda(Request $request)
    {
        $query = $request->input('query');

        $tareas = Tarea::with('user')
            ->where('servicio', 'like', "%{$query}%")
            ->orWhere('descripcion', 'like', "%{$query}%")
            ->get();

        $usuarios = User::role('cliente')->orderBy('name')->get();

        return view('tareas.busqueda', compact('tareas','query','usuarios'));
    }

    public function pdf()
    {
        $tareas = Tarea::with('user')->get();
        $pdf = PDF::loadView('tareas.pdf', compact('tareas'));
        return $pdf->download('tareas.pdf');
    }

    public function misTareas()
    {
        $user = auth()->user();
        $tareas = Tarea::where('user_id', $user->id)->orderBy('fecha_creacion', 'desc')->get();

        return view('tareas.mis_tareas', compact('tareas'));
    }
}
