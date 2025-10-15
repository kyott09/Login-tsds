<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user','vehicle'])->paginate(15);
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $users = User::pluck('name','id');
        $vehicles = Vehicle::pluck('patente','id');
        return view('employees.create', compact('users','vehicles'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();
        Employee::create($data);
        return redirect()->route('employees.index')->with('success','Empleado creado correctamente.');
    }

    public function show(Employee $employee)
    {
        $employee->load(['user','vehicle']);
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        $users = User::pluck('name','id');
        $vehicles = Vehicle::pluck('patente','id');
        return view('employees.edit', compact('employee','users','vehicles'));
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->validated();
        $employee->update($data);
        return redirect()->route('employees.index')->with('success','Empleado actualizado correctamente.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success','Empleado eliminado correctamente.');
    }
}
