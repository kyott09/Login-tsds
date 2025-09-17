@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Registrar Nueva Tarea de Trabajo') }}</div>

                <div class="card-body">
                    <form action="{{ route('tareas.store') }}" method="POST">
                        @csrf

                        <!-- Número de Tarea (asumido autogenerado por backend) -->
                        <div class="form-group mb-3">
                            <label for="numero_tarea">Número de Tarea</label>
                            <input type="text" class="form-control" id="numero_tarea" name="numero_tarea" value="{{ old('numero_tarea', $numeroTarea ?? 'Auto') }}" readonly>
                        </div>

                        <!-- Datos del Cliente -->
                        <h5>Datos del Cliente</h5>
                        <div class="form-group mb-3">
                            <label for="nombre_cliente">Nombre</label>
                            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="apellido_cliente">Apellido</label>
                            <input type="text" class="form-control" id="apellido_cliente" name="apellido_cliente" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="dni_cliente">DNI</label>
                            <input type="text" class="form-control" id="dni_cliente" name="dni_cliente" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="telefono_cliente">Teléfono</label>
                            <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="direccion_cliente">Dirección</label>
                            <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" required>
                        </div>

                        <!-- Descripción de la tarea -->
                        <div class="form-group mb-3">
                            <label for="descripcion">Descripción de la Tarea</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                        </div>

                        <!-- Estado -->
                        <div class="form-group mb-4">
                            <label for="estado">Estado de la Tarea</label>
                            <select class="form-control" id="estado" name="estado" required>
                                <option value="vista">Vista</option>
                                <option value="en proceso">En Proceso</option>
                                <option value="terminada">Terminada</option>
                                <option value="no terminada">No Terminada</option>
                            </select>
                        </div>

                        <!-- Botón -->
                        <button type="submit" class="btn btn-primary">Guardar Tarea</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
