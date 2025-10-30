
// {{-- Modal Ver --}}
<div class="modal fade" id="verModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detalles del Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>Usuario:</strong> <span id="verUsuario"></span></p>
                <p><strong>Email:</strong> <span id="verEmail"></span></p>
                <p><strong>Vehículo:</strong> <span id="verVehicle"></span></p>
                <p><strong>Fecha Ingreso:</strong> <span id="verFecha"></span></p>
                <p><strong>Estado Laboral:</strong> <span id="verEstado"></span></p>
                <p><strong>Skills:</strong> <span id="verSkills"></span></p>
                <p><strong>Fecha Inicio Licencia:</strong> <span id="verFechaInicioLicencia"></span></p>
                <p><strong>Fecha Fin Licencia:</strong> <span id="verFechaFinLicencia"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

// {{-- Modal Editar --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Editar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editUsuario" class="form-label">Usuario</label>
                        <select name="user_id" id="editUsuario" class="form-control">
                            <option value="">-- Ninguno --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="editVehicle" class="form-label">Vehículo</label>
                        <select name="vehicle_id" id="editVehicle" class="form-control">
                            <option value="">-- Ninguno --</option>
                            @foreach($vehicles as $vehicle)  <!-- Cambiado: ahora itera sobre objetos $vehicle -->
                                <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>{{ $vehicle->patente }}</option>  <!-- Muestra patente legible -->
                            @endforeach
                        </select>
                        @error('vehicle_id')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <!-- Resto de los campos igual -->
                    <div class="mb-3">
                        <label for="editFecha" class="form-label">Fecha Ingreso</label>
                        <input type="date" name="fecha_ingreso" id="editFecha" class="form-control" value="{{ old('fecha_ingreso') }}">
                        @error('fecha_ingreso')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="editSkills" class="form-label">Skills</label>
                        <textarea name="skills" id="editSkills" class="form-control">{{ old('skills') }}</textarea>
                        @error('skills')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="editEstado" class="form-label">Estado Laboral</label>
                        <select name="estado_laboral" id="editEstado" class="form-control">
                            <option value="">-- Seleccione estado --</option>
                            <option value="activo" {{ old('estado_laboral') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="licencia" {{ old('estado_laboral') == 'licencia' ? 'selected' : '' }}>Licencia</option>
                            <option value="inactivo" {{ old('estado_laboral') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                        @error('estado_laboral')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="editFechaInicioLicencia" class="form-label">Fecha Inicio Licencia</label>
                        <input type="date" name="fecha_inicio_licencia" id="editFechaInicioLicencia" class="form-control" value="{{ old('fecha_inicio_licencia') }}">
                        @error('fecha_inicio_licencia')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="editFechaFinLicencia" class="form-label">Fecha Fin Licencia</label>
                        <input type="date" name="fecha_fin_licencia" id="editFechaFinLicencia" class="form-control" value="{{ old('fecha_fin_licencia') }}">
                        @error('fecha_fin_licencia')<div class="text-danger">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Eliminar --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Eliminar Empleado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>¿Seguro que deseas eliminar al empleado <strong id="deleteUsuario"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
