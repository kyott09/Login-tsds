<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use Barryvdh\DomPDF\facades\PDF;

class EmployeeController extends Controller
{
    public function index()
    {
        // Obtener empleados con relaciones, filtrados por usuarios con rol 'empleado'
        $employees = Employee::with(['user', 'vehicle'])
            ->whereHas('user', function($q) {
                $q->role('empleado');  // Filtra empleados donde el user tiene rol 'empleado' (Spatie)
            })
            ->paginate(15);

        // Obtener datos para el select de edición (ya filtrado por rol 'empleado')
        $users = User::role('empleado')->get();
        $vehicles = Vehicle::all();

        return view('employees.index', compact('employees', 'users', 'vehicles'));
    }

    public function create()
    {
        // Usuarios que ya tienen el rol de empleado
        $empleadosExistentes = \App\Models\User::role('empleado')->pluck('id');

        // Usuarios con tareas pendientes o solicitadas
        $usuariosConTareas = \App\Models\Tarea::pluck('user_id');

        // Filtrar usuarios disponibles: sin rol de empleado y sin tareas
        $users = \App\Models\User::whereNotIn('id', $empleadosExistentes)
            ->whereNotIn('id', $usuariosConTareas)
            ->pluck('name', 'id');

        // Vehículos disponibles (si querés también podrías filtrar los ya asignados)
        $vehicles = \App\Models\Vehicle::pluck('patente', 'id');

        return view('employees.create', [
            'action' => route('employees.store'),
            'method' => 'POST',
            'users' => $users,
            'vehicles' => $vehicles,
        ]);
    }


    public function store(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'vehicle_id' => 'nullable|exists:vehicles,id',
            'fecha_ingreso' => 'required|date',
            'skills' => 'nullable|string',
            'estado_laboral' => 'required|in:activo,licencia,inactivo',
            'fecha_inicio_licencia' => 'nullable|date',
            'fecha_fin_licencia' => 'nullable|date',
        ]);

        // Crear empleado
        $employee = \App\Models\Employee::create($validated);

        // 🔹 Asignar rol "empleado" al usuario seleccionado
        if ($employee->user_id) {
            $user = \App\Models\User::find($employee->user_id);
            if ($user && !$user->hasRole('empleado')) {
                $user->assignRole('empleado');
            }
        }

        return redirect()->route('employees.index')
            ->with('success', 'Empleado creado correctamente y rol asignado.');
    }


    public function show(Employee $employee)
    {
        $employee->load(['user','vehicle']);
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $users = User::role('empleado')->pluck('name','id');  // Filtrado aplicado
        $vehicles = Vehicle::pluck('patente','id');
        return view('employees.edit', compact('employee','users','vehicles'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();

        // 🔹 Actualizar los datos del empleado
        $employee->update($data);

        // 🔹 Si viene un nombre en el request, actualizamos el usuario asociado
        if ($request->filled('name') && $employee->user) {
            $employee->user->update([
                'name' => $request->input('name'),
            ]);
        }

        return redirect()->route('employees.index')
            ->with('success', 'Empleado actualizado correctamente.');
    }


    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Empleado eliminado correctamente.');
    }

    public function busqueda(Request $request)
    {
        $employees = Employee::with(['user','vehicle'])->get();

        // Traer datos para modal de edición (filtrado por rol 'empleado')
        $users = User::role('empleado')->get();  // Filtrado aplicado
        $vehicles = Vehicle::all();

        return view('employees.busqueda', compact('employees','users','vehicles'));
    }

    public function pdf()
    {
        $employees = \App\Models\Employee::with(['user','vehicle'])->get();
        $pdf = \PDF::loadView('employees.pdf', compact('employees'));
        return $pdf->download('empleados.pdf');
    }
}