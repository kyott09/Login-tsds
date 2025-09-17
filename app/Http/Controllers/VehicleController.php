<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $vehiculos = Vehicle::with('modelo.brand')->get();
        return view('vehicle.index', compact('vehiculos'));
    }

    public function create()
    {
        $modelos = VehicleModel::with('brand')->get();
        return view('vehicle.create', compact('modelos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patente' => 'required|unique:vehicles,patente',
            'modelo_id' => 'required|exists:vehicle_models,id',
            'color' => 'nullable|string|max:50',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo registrado exitosamente');
    }

    public function edit(Vehicle $vehiculo)
    {
        $modelos = VehicleModel::with('brand')->get();
        return view('vehicle.edit', compact('vehiculo', 'modelos'));
    }

    public function update(Request $request, Vehicle $vehiculo)
    {
        $request->validate([
            'patente' => 'required|unique:vehicles,patente,' . $vehiculo->id,
            'modelo_id' => 'required|exists:vehicle_models,id',
            'color' => 'nullable|string|max:50',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado exitosamente');
    }

    public function destroy(Vehicle $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado exitosamente');
    }
}
