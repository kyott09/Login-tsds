@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">Listado de Tareas</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tareas.create') }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Servicio</th>
                <th>Prioridad</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->id }}</td>
                    {{-- Nombre del cliente (User) --}}
                    <td>
                        @if($tarea->user)
                            {{ $tarea->user->name }} ({{ $tarea->user->email }})
                        @else
                            <em>Sin cliente</em>
                        @endif
                    </td>
                    {{-- Servicio --}}
                    <td>{{ ucfirst(str_replace('_',' ',$tarea->servicio)) }}</td>
                    {{-- Prioridad --}}
                    <td>{{ ucfirst($tarea->prioridad) }}</td>
                    {{-- Fecha de creación --}}
                    <td>{{ \Carbon\Carbon::parse($tarea->fecha_creacion)->format('d/m/Y') }}</td>
                    {{-- Estado --}}
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    {{-- Acciones --}}
                    <td>
                        <a href="{{ route('tareas.edit', $tarea) }}" class="btn btn-sm btn-warning">Editar</a>
                        <!-- Botón eliminar opcional -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
