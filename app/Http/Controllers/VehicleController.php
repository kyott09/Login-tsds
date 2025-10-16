<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\VehicleModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class VehicleController extends Controller
{

    public function index(Request $request)
    {
        $brands = Brand::all();
        $vehiculos = Vehicle::with('modelo.brand');

        if ($request->filled('modelo_id')) {
            $vehiculos = $vehiculos->where('modelo_id', $request->modelo_id);
        }

        if ($request->filled('desde')) {
            $vehiculos = $vehiculos->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $vehiculos = $vehiculos->whereDate('created_at', '<=', $request->hasta);
        }

        $vehiculos = $vehiculos->orderBy('created_at', 'desc')->get();

        // Traemos los modelos para el select del modal de edición
        $modelos = VehicleModel::with('brand')->get();

        if ($request->has('pdf')) {
            return $this->exportPDF($request);
        }

        return view('vehicle.index', [
            'vehiculos' => $vehiculos,
            'brands' => $brands,
            'modelos' => $modelos, // <-- agregamos modelos
            'modelo_id' => $request->modelo_id,
            'desde' => $request->desde,
            'hasta' => $request->hasta,
        ]);
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

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado exitosamente');
    }

    public function destroy(Vehicle $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado exitosamente');
    }

    public function exportPdf(Request $request)
    {
        $desde = $request->desde;
        $hasta = $request->hasta;
        $modelo_id = $request->modelo_id;

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

        $pdf = Pdf::loadView('vehicle.pdf', compact('vehiculos', 'desde', 'hasta', 'modelo_id'));
        return $pdf->download('vehiculos_report.pdf');
    }


}
