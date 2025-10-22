@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Solicitar nueva tarea</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('tareas.store') }}" method="POST" class="mt-3">
        @csrf

        {{-- Usuario actual --}}
        <div class="mb-3">
            <label class="form-label">Cliente</label>
            <input type="text" class="form-control" value="{{ Auth::user()->name }} ({{ Auth::user()->email }})" readonly>
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </div>

        {{-- Servicio --}}
        <div class="mb-3">
            <label class="form-label">Servicio</label>
            <select name="servicio" class="form-select" required>
                <option value="">Seleccione un servicio</option>
                <option value="mantenimiento">Mantenimiento</option>
                <option value="instalacion">Instalación</option>
                <option value="reparacion">Reparación</option>
            </select>
        </div>

        {{-- Descripción --}}
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4" required></textarea>
        </div>

        {{-- Datos automáticos (no visibles) --}}
        <input type="hidden" name="fecha_creacion" value="{{ now() }}">
        <input type="hidden" name="estado" value="En proceso">
        <input type="hidden" name="prioridad" value="{{ Auth::user()->prioridad }}">

        {{-- Botón --}}
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Enviar solicitud</button>
        </div>
    </form>
</div>
@endsection
