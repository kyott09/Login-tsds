
{{-- Modal Editar --}}
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title">Editar Vehículo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Patente</label>
                        <input type="text" name="patente" id="editPatente" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Color</label>
                        <input type="text" name="color" id="editColor" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Modelo</label>
                        <select name="modelo_id" id="editModelo" class="form-control">
                            @foreach($modelos as $modelo)
                                <option value="{{ $modelo->id }}">{{ $modelo->descripcion }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Estado</label>
                        <select name="estado" id="editEstado" class="form-control">
                            <option value="activo">Activo</option>
                            <option value="inactivo">Inactivo</option>
                        </select>
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
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro que deseas eliminar el vehículo <strong id="deletePatente"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Modal Ver Vehículo --}}
<div class="modal fade" id="verModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">Detalles del Vehículo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="verId"></span></p>
                <p><strong>Patente:</strong> <span id="verPatente"></span></p>
                <p><strong>Modelo:</strong> <span id="verModelo"></span></p>
                <p><strong>Marca:</strong> <span id="verMarca"></span></p>
                <p><strong>Color:</strong> <span id="verColor"></span></p>
                <p><strong>Estado:</strong> <span id="verEstado"></span></p>
                <p><strong>Fecha de Creación:</strong> <span id="verFecha"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

