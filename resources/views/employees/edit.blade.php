@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Empleado</h1>
    @include('employees.form', ['action' => route('employees.update', $employee), 'method' => 'PUT', 'employee' => $employee])
</div>
@endsection
