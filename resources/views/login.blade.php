@extends('layouts.admin')

@section('content')
<div class="container" style="max-width:400px;">
    <h2 class="mb-4">Iniciar sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="user" class="form-label">Usuario</label>
            <input type="text" name="user" id="user" class="form-control" value="{{ old('user') }}" required autofocus>
            @error('user')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" id="password" class="form-control" required>
            @error('password')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Recordarme</label>
        </div>
        <button type="submit" class="btn btn-primary w-100">Ingresar</button>
    </form>
</div>
@endsection
