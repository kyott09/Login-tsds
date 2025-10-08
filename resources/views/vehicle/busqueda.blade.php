<form action="{{ route('vehiculos.index') }}" method="GET" autocomplete="on" role="search">
    <div class="row">
        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <label for="modelo_id">Modelo</label>
            <select name="modelo_id" id="modelo_id" class="form-control">
                <option value="">-- Todos los modelos --</option>
                @foreach($brands as $modelo)
                    <option value="{{ $modelo->id }}" {{ request('modelo_id') == $modelo->id ? 'selected' : '' }}>
                        {{ $modelo->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <label for="desde">Fecha Desde</label>
            <input 
                type="date" 
                name="desde" 
                id="desde" 
                class="form-control" 
                value="{{ request('desde') }}">
        </div>

        <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
            <label for="hasta">Fecha Hasta</label>
            <input 
                type="date" 
                name="hasta" 
                id="hasta" 
                class="form-control" 
                value="{{ request('hasta') }}">
        </div>

        <div class="col-lg-3 col-md-12 col-sm-12 mb-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary mr-2">
                <i class="fas fa-filter"></i> Filtrar
            </button>
            <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">
                <i class="fas fa-eraser"></i> Limpiar
            </a>
        </div>
    </div>
</form>
