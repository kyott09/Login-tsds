<?php

namespace App\Http\Controllers;

use App\Models\VehicleModel;
use App\Models\Brand;
use Illuminate\Http\Request;

class VehicleModelController extends Controller
{
    public function index()
    {
        $models = VehicleModel::with('brand')->get();
        return view('vehicle_model.index', compact('models'));
    }

    public function create()
    {
        $brands = Brand::all();
        return view('vehicle_model.create', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:vehicle_models,descripcion',
            'brand_id' => 'required|exists:brands,id',
        ]);

        VehicleModel::create($request->all());

        return redirect()->route('vehicle_models.index')
            ->with('success', 'Modelo de vehículo creado exitosamente');
    }

    public function edit(VehicleModel $vehicleModel)
    {
        $brands = Brand::all();
        return view('vehicle_model.edit', compact('vehicleModel', 'brands'));
    }

    public function update(Request $request, VehicleModel $vehicleModel)
    {
        $request->validate([
            'descripcion' => 'required|string|max:100|unique:vehicle_models,descripcion,' . $vehicleModel->id,
            'brand_id' => 'required|exists:brands,id',
        ]);

        $vehicleModel->update($request->all());

        return redirect()->route('vehicle_models.index')
            ->with('success', 'Modelo de vehículo actualizado exitosamente');
    }

    public function destroy(VehicleModel $vehicleModel)
    {
        $vehicleModel->delete();
        return redirect()->route('vehicle_models.index')
            ->with('success', 'Modelo de vehículo eliminado exitosamente');
    }
}
