@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Gestión de Roles</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol Actual</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if($user->roles->isNotEmpty())
                        {{ $user->roles->pluck('name')->join(', ') }}
                    @else
                        <span class="text-muted">Sin rol</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('roles.edit', $user->id) }}" class="btn btn-sm btn-primary">Editar Rol</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
