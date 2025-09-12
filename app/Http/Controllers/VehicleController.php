<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the vehicles.
     */
    public function index()
    {
        $vehiculos = Vehicle::with('modelo')->get(); // Traemos también el modelo
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new vehicle.
     */
    public function create()
    {
        $modelos = VehicleModel::all(); // Para el dropdown de modelos
        return view('vehiculos.create', compact('modelos'));
    }

    /**
     * Store a newly created vehicle in storage.
     */
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

    /**
     * Show the form for editing the specified vehicle.
     */
    public function edit(Vehicle $vehiculo)
    {
        $modelos = VehicleModel::all();
        return view('vehiculos.edit', compact('vehiculo', 'modelos'));
    }

    /**
     * Update the specified vehicle in storage.
     */
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

    /**
     * Remove the specified vehicle from storage.
     */
    public function destroy(Vehicle $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado exitosamente');
    }
}
