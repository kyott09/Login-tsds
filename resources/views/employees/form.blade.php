@php
    $e = $employee ?? null;
@endphp

<form action="{{ $action }}" method="POST">
    @csrf
    @if(in_array($method, ['PUT','PATCH']))
        @method($method)
    @endif

    <div class="mb-3">
        <label for="user_id" class="form-label">Usuario</label>
        <select name="user_id" id="user_id" class="form-control">
            <option value="">-- Ninguno --</option>
            @foreach($users as $id => $name)
                <option value="{{ $id }}" {{ old('user_id', optional($e)->user_id) == $id ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
        @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="vehicle_id" class="form-label">Vehículo</label>
        <select name="vehicle_id" id="vehicle_id" class="form-control">
            <option value="">-- Ninguno --</option>
            @foreach($vehicles as $id => $patente)
                <option value="{{ $id }}" {{ old('vehicle_id', optional($e)->vehicle_id) == $id ? 'selected' : '' }}>{{ $patente }}</option>
            @endforeach
        </select>
        @error('vehicle_id')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="fecha_ingreso" class="form-label">Fecha Ingreso</label>
        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', optional(optional($e)->fecha_ingreso)->format('Y-m-d')) }}">
        @error('fecha_ingreso')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="skills" class="form-label">Skills</label>
        <textarea name="skills" id="skills" class="form-control">{{ old('skills', optional($e)->skills) }}</textarea>
        @error('skills')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="estado_laboral" class="form-label">Estado Laboral</label>
        <select name="estado_laboral" id="estado_laboral" class="form-control">
            <option value="">-- Seleccione estado --</option>
            <option value="activo" {{ old('estado_laboral', optional($e)->estado_laboral) == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="licencia" {{ old('estado_laboral', optional($e)->estado_laboral) == 'licencia' ? 'selected' : '' }}>Licencia</option>
            <option value="inactivo" {{ old('estado_laboral', optional($e)->estado_laboral) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
        @error('estado_laboral')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="fecha_inicio_licencia" class="form-label">Fecha Inicio Licencia</label>
        <input type="date" name="fecha_inicio_licencia" id="fecha_inicio_licencia" class="form-control" value="{{ old('fecha_inicio_licencia', optional(optional($e)->fecha_inicio_licencia)->format('Y-m-d')) }}">
        @error('fecha_inicio_licencia')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label for="fecha_fin_licencia" class="form-label">Fecha Fin Licencia</label>
        <input type="date" name="fecha_fin_licencia" id="fecha_fin_licencia" class="form-control" value="{{ old('fecha_fin_licencia', optional(optional($e)->fecha_fin_licencia)->format('Y-m-d')) }}">
        @error('fecha_fin_licencia')<div class="text-danger">{{ $message }}</div>@enderror
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('employees.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
