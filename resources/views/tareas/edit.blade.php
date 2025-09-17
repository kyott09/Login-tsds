@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Tarea #{{ $tarea->id }}</h2>

    <form action="{{ route('tareas.update', $tarea) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos igual que en create -->
        <div class="form-group mb-3">
            <label for="nombre_cliente">Nombre</label>
            <input type="text" class="form-control" name="nombre_cliente" value="{{ old('nombre_cliente', $tarea->nombre_cliente) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="apellido_cliente">Apellido</label>
            <input type="text" class="form-control" name="apellido_cliente" value="{{ old('apellido_cliente', $tarea->apellido_cliente) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="dni_cliente">DNI</label>
            <input type="text" class="form-control" name="dni_cliente" value="{{ old('dni_cliente', $tarea->dni_cliente) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="telefono_cliente">Teléfono</label>
            <input type="text" class="form-control" name="telefono_cliente" value="{{ old('telefono_cliente', $tarea->telefono_cliente) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="direccion_cliente">Dirección</label>
            <input type="text" class="form-control" name="direccion_cliente" value="{{ old('direccion_cliente', $tarea->direccion_cliente) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" required>{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="form-group mb-4">
            <label for="estado">Estado</label>
            <select class="form-control" name="estado" required>
                @foreach(['vista', 'en proceso', 'terminada', 'no terminada'] as $estado)
                    <option value="{{ $estado }}" {{ $tarea->estado === $estado ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Tarea</button>
        <a href="{{ route('tareas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
