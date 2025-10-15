@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Crear Empleado</h1>
    @include('employees.form', ['action' => route('employees.store'), 'method' => 'POST', 'employee' => null])
</div>
@endsection
