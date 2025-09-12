@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Editar Modelo de Vehículo</div>
                <div class="card-body">
                    <form action="{{ route('vehicle-models.update', $vehicleModel->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Modelo</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $vehicleModel->nombre) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar Modelo</button>
                        <a href="{{ route('vehicle-models.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
