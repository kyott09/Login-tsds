<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTareaRequest;
use App\Http\Requests\UpdateTareaRequest;

class TareaController extends Controller
{
    /**
     * Muestra el listado de todas las tareas.
     */
    public function index()
    {
        $tareas = Tarea::all();
        return view('tareas.index', compact('tareas'));
    }

    /**
     * Muestra el formulario para crear una nueva tarea.
     */
    public function create()
    {
        $numeroTarea = Tarea::max('id') + 1; // Número autoincremental simulado
        return view('tareas.create', compact('numeroTarea'));
    }

    /**
     * Almacena una nueva tarea en la base de datos.
     */
    public function store(StoreTareaRequest $request)
    {
        $tarea = new Tarea();
        $tarea->nombre_cliente = $request->input('nombre_cliente');
        $tarea->apellido_cliente = $request->input('apellido_cliente');
        $tarea->dni_cliente = $request->input('dni_cliente');
        $tarea->telefono_cliente = $request->input('telefono_cliente');
        $tarea->direccion_cliente = $request->input('direccion_cliente');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = $request->input('estado');
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea creada exitosamente.');
    }

    /**
     * Muestra los detalles de una tarea (opcional).
     */
    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Muestra el formulario para editar una tarea existente.
     */
    public function edit(Tarea $tarea)
    {
        return view('tareas.edit', compact('tarea'));
    }

    /**
     * Actualiza una tarea existente en la base de datos.
     */
    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        $tarea->nombre_cliente = $request->input('nombre_cliente');
        $tarea->apellido_cliente = $request->input('apellido_cliente');
        $tarea->dni_cliente = $request->input('dni_cliente');
        $tarea->telefono_cliente = $request->input('telefono_cliente');
        $tarea->direccion_cliente = $request->input('direccion_cliente');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->estado = $request->input('estado');
        $tarea->save();

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada exitosamente.');
    }

    /**
     * Elimina una tarea de la base de datos.
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada exitosamente.');
    }
}
