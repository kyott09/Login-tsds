@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Editar Tarea #{{ $tarea->id }}</h2>

    <form action="{{ route('tareas.update', $tarea) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Cliente (User) --}}
        <div class="form-group mb-3">
            <label for="user_id">Cliente</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $tarea->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha de creación --}}
        <div class="form-group mb-3">
            <label for="fecha_creacion">Fecha de creación</label>
            <input type="date" class="form-control" name="fecha_creacion" value="{{ old('fecha_creacion', $tarea->fecha_creacion) }}" required>
        </div>

        {{-- Servicio --}}
        <div class="form-group mb-3">
            <label for="servicio">Servicio</label>
            <select class="form-control" name="servicio" required>
                @foreach(['instalacion_wifi', 'mantenimiento_redes', 'configuracion_router', 'extension_cobertura', 'diagnostico_problemas', 'instalacion_camaras'] as $servicio)
                    <option value="{{ $servicio }}" {{ $tarea->servicio === $servicio ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_',' ',$servicio)) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Prioridad --}}
        <div class="form-group mb-3">
            <label for="prioridad">Prioridad</label>
            <select class="form-control" name="prioridad" required>
                @foreach(['premium', 'basico'] as $prioridad)
                    <option value="{{ $prioridad }}" {{ $tarea->prioridad === $prioridad ? 'selected' : '' }}>
                        {{ ucfirst($prioridad) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Descripción --}}
        <div class="form-group mb-3">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" name="descripcion" required>{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        {{-- Estado --}}
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
