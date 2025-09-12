<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = VehicleModel::all();
        return view('vehicle_models.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     */
// Para crear vehículo
    public function create()
    {
        $modelos = VehicleModel::all();
        return view('vehiculos.create', compact('modelos'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:vehicle_models,nombre',
        ]);

        VehicleModel::create($request->all());

        return redirect()->route('vehicle-models.index')
            ->with('success', 'Modelo de vehículo creado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
// Para editar vehículo
    public function edit(Vehicle $vehiculo)
    {
        $modelos = VehicleModel::all();
        return view('vehiculos.edit', compact('vehiculo', 'modelos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VehicleModel $vehicleModel)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:vehicle_models,nombre,' . $vehicleModel->id,
        ]);

        $vehicleModel->update($request->all());

        return redirect()->route('vehicle-models.index')
            ->with('success', 'Modelo de vehículo actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();
        return redirect()->route('vehicle-models.index')
            ->with('success', 'Modelo de vehículo eliminado exitosamente');
    }
}
