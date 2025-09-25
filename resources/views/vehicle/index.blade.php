@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Listado de Vehículos</span>
                    @can('crear vehiculo')
                        <a href="{{ route('vehiculos.create') }}" class="btn btn-primary btn-sm">Registrar Vehículo</a>
                    @endcan
                </div>
                <div class="card-body">

                    {{-- Mensajes de éxito --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patente</th>
                                <th>Modelo</th>
                                <th>Color</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vehiculos as $vehiculo)
                                <tr>
                                    <td>{{ $vehiculo->id }}</td>
                                    <td>{{ $vehiculo->patente }}</td>
                                    <td>
                                        {{ $vehiculo->modelo->descripcion ?? 'Sin modelo' }}
                                        @if($vehiculo->modelo && $vehiculo->modelo->brand)
                                            ({{ $vehiculo->modelo->brand->descripcion }})
                                        @endif
                                    </td>
                                    <td>{{ $vehiculo->color }}</td>
                                    <td>{{ ucfirst($vehiculo->estado) }}</td>
                                    <td>
                                        @can ('editar vehiculos')
                                        <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                        @endcan
                                        @can ('borrar vehiculos')
                                        <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro de eliminar?')">Eliminar</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
