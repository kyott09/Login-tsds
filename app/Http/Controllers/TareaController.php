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
    public function rules()
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'servicio' => ['required', 'string', 'max:255'],
            'prioridad' => ['required', 'in:premium,basico'],
            'descripcion' => ['required', 'string'],
            'estado' => ['required', 'in:vista,en proceso,terminada,no terminada'],
            'fecha_creacion' => ['nullable', 'date'],
            'fecha_fin' => ['nullable', 'date'],

            // Validación condicional: si el estado es "terminada", fecha_fin es obligatoria
            'fecha_fin' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) {
                    if ($this->input('estado') === 'terminada' && empty($value)) {
                        $fail('Debés ingresar la fecha de finalización si marcás la tarea como terminada.');
                    }
                },
            ],
        ];
    }

    public function index()
    {
        $tareas = Tarea::with('user')->get();
        $users = User::all();
        return view('tareas.index', compact('tareas', 'users'));
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

        $tareaExistente = Tarea::where('user_id', $request->input('user_id'))
            ->where('servicio', $request->input('servicio'))
            ->where('estado', '!=', 'terminada')
            ->first();
        
        if ($tareaExistente) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Ya tienes una solicitud activa para este servicio. Espera a que se marque como "Terminada" antes de solicitar otra.');
        }

        $tarea = new Tarea();
        $tarea->user_id = $request->input('user_id');
        $tarea->fecha_creacion = $request->input('fecha_creacion') ?? now();
        $tarea->fecha_fin = $request->input('fecha_fin'); 
        $tarea->servicio = $request->input('servicio');
        $tarea->prioridad = $request->input('prioridad');
        $tarea->descripcion = $request->input('descripcion');

        $tarea->estado = $request->input('fecha_fin') ? 'Terminada' : ($request->input('estado') ?? 'en proceso');

        $tarea->save();

        if ($user->hasRole('cliente') || $user->hasRole('premium')) {
            return redirect()->route('tareas.mis_tareas')
                            ->with('success', 'Tarea solicitada correctamente.');
        } else {
            return redirect()->route('tareas.index')
                            ->with('success', 'Tarea registrada correctamente.');
        }
    }


    public function update(UpdateTareaRequest $request, Tarea $tarea)
    {
        $tarea->user_id = $request->input('user_id');
        $tarea->fecha_creacion = $request->input('fecha_creacion');
        $tarea->fecha_fin = $request->input('fecha_fin'); 
        $tarea->servicio = $request->input('servicio');
        $tarea->prioridad = $request->input('prioridad');
        $tarea->descripcion = $request->input('descripcion');

        $tarea->estado = $request->input('fecha_fin') ? 'Terminada' : $request->input('estado');

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

        return view('tareas.busqueda', compact('tareas', 'query', 'usuarios'));
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
        $tareas = Tarea::where('user_id', $user->id)
            ->orderBy('fecha_creacion', 'desc')
            ->get();

        return view('tareas.mis_tareas', compact('tareas'));
    }

}



