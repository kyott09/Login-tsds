@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1>Editar Rol de {{ $user->name }}</h1>

    <form action="{{ route('roles.update', $user->id) }}" method="POST" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="role" class="form-label">Seleccionar nuevo rol</label>
            <select name="role" id="role" class="form-select">
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" 
                        {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
            @error('role')
                <div class="text-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
