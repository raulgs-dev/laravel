@extends('layout')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0"><i class="bi bi-plus-square text-success"></i> Nuevo Producto</h2>
</div>

<div class="card">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nombre *</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre') }}" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Precio (€) *</label>
                    <input type="number" name="precio" step="0.01" min="0"
                           class="form-control @error('precio') is-invalid @enderror"
                           value="{{ old('precio') }}" required>
                    @error('precio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-3">
                    <label class="form-label fw-semibold">Cantidad *</label>
                    <input type="number" name="cantidad" min="0"
                           class="form-control @error('cantidad') is-invalid @enderror"
                           value="{{ old('cantidad') }}" required>
                    @error('cantidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Descripción</label>
                    <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror"
                              rows="3">{{ old('descripcion') }}</textarea>
                    @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Imagen del Producto</label>
                    <input type="file" name="imagen" class="form-control @error('imagen') is-invalid @enderror"
                           accept="image/*" id="imagenInput">
                    <small class="text-muted">JPG, PNG, GIF – máx. 2MB</small>
                    @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <img id="previewImg" src="" style="max-height:100px; border-radius:8px; margin-top:8px; display:none;">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Ficha PDF del Producto</label>
                    <input type="file" name="pdf" class="form-control @error('pdf') is-invalid @enderror"
                           accept=".pdf" id="pdfInput">
                    <small class="text-muted">Solo PDF – máx. 5MB</small>
                    @error('pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div id="pdfNombre" class="text-success mt-1" style="display:none;">
                        <i class="bi bi-file-pdf"></i> <span id="pdfNombreTexto"></span>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Guardar Producto
                </button>
                <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('imagenInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = e => {
                const img = document.getElementById('previewImg');
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('pdfInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            document.getElementById('pdfNombreTexto').textContent = file.name;
            document.getElementById('pdfNombre').style.display = 'block';
        }
    });
</script>
@endpush
