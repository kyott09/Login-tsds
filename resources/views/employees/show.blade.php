@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Empleado #{{ $employee->id }}</h1>

    <p><strong>Usuario:</strong> {{ $employee->user ? $employee->user->name : '-' }}</p>
    <p><strong>Tipo:</strong> {{ $employee->typeEmployee ? $employee->typeEmployee->descripcion : '-' }}</p>
    <p><strong>Vehículo:</strong> {{ $employee->vehicle ? $employee->vehicle->patente : '-' }}</p>
    <p><strong>Fecha Ingreso:</strong> {{ optional($employee->fecha_ingreso)->format('Y-m-d') }}</p>
    <p><strong>Skills:</strong> {{ $employee->skills }}</p>
    <p><strong>Estado laboral:</strong> {{ $employee->estado_laboral }}</p>
    <p><strong>Licencia desde:</strong> {{ optional($employee->fecha_inicio_licencia)->format('Y-m-d') }}</p>
    <p><strong>Licencia hasta:</strong> {{ optional($employee->fecha_fin_licencia)->format('Y-m-d') }}</p>

    <a href="{{ route('employees.edit', $employee) }}" class="btn btn-warning">Editar</a>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Volver</a>
</div>
@endsection
