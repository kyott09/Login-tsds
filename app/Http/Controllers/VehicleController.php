<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

        public function index(Request $request)
    {
        $brands = Brand::all();
        $desde = $request->desde;
        $hasta = $request->hasta;
        $modelo_id = $request->modelo_id;
        if(count($request->all()) > 0) {
            $sql = Vehicle::with('modelo.brand');
            if($modelo_id) {
                $sql = $sql->where('modelo_id', $modelo_id);
            }
            if($desde) {
                $sql = $sql->whereDate('created_at', '>=', $desde);
            }
            if($hasta) {
                $sql = $sql->whereDate('created_at', '<=', $hasta);
            }
            $vehiculos = $sql
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $vehiculos = Vehicle::with('modelo.brand')
                ->orderBy('created_at', 'desc')
                ->get();
            $modelo_id = null;
            $desde = null;
            $hasta = null;
        }

        return view('vehicle.index', compact('vehiculos',
            'brands',
            'modelo_id',
            'desde',
            'hasta'
        ));
    }


    

    public function create()
    {
        // Trae marcas con modelos asociados
        $brands = \App\Models\Brand::with('vehicleModels')->get();

        return view('vehicle\create', compact('brands'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'patente' => 'required|unique:vehicles,patente',
            'modelo_id' => 'required|exists:vehicle_models,id',
            'color' => 'nullable|string|max:50',
            'descripcion' => 'nullable|string|max:255',
            'estado' => 'required|in:disponible,no disponible',
        ], [
            'patente.required' => 'El campo Patente es obligatorio.',
            'patente.unique' => 'La patente ya está registrada.',
            'modelo_id.required' => 'Debe seleccionar un modelo.',
            'modelo_id.exists' => 'El modelo seleccionado no es válido.',
            'color.max' => 'El color no puede tener más de 50 caracteres.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);


        Vehicle::create($request->all());

        return redirect()->route('vehicle.index')
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
            'estado' => 'required|in:disponible,no disponible',
        ], [
            'patente.required' => 'El campo Patente es obligatorio.',
            'patente.unique' => 'La patente ya está registrada.',
            'modelo_id.required' => 'Debe seleccionar un modelo.',
            'modelo_id.exists' => 'El modelo seleccionado no es válido.',
            'color.max' => 'El color no puede tener más de 50 caracteres.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);



        $vehiculo->update($request->all());

        return redirect()->route('vehicle.index')
            ->with('success', 'Vehículo actualizado exitosamente');
    }

    public function destroy(Vehicle $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehicle.index')
            ->with('success', 'Vehículo eliminado exitosamente');
    }
}
