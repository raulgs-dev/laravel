@extends('layout')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0"><i class="bi bi-pencil-square text-warning"></i> Editar Cliente</h2>
</div>

<div class="card">
    <div class="card-body p-4">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('clientes.update', $cliente) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nombre *</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                           value="{{ old('nombre', $cliente->nombre) }}" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Email *</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $cliente->email) }}" required>
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Teléfono *</label>
                    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror"
                           value="{{ old('telefono', $cliente->telefono) }}" required>
                    @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Foto (opcional)</label>
                    @if($cliente->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $cliente->foto) }}" style="max-height:80px; border-radius:8px;" id="previewImg">
                        </div>
                    @else
                        <div class="mb-2"><img id="previewImg" src="" style="max-height:80px; border-radius:8px; display:none;"></div>
                    @endif
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                           accept="image/*" id="fotoInput">
                    <small class="text-muted">Deja vacío para conservar la foto actual</small>
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold">Dirección *</label>
                    <textarea name="direccion" class="form-control @error('direccion') is-invalid @enderror"
                              rows="3" required>{{ old('direccion', $cliente->direccion) }}</textarea>
                    @error('direccion')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-warning">
                    <i class="bi bi-save"></i> Actualizar Cliente
                </button>
                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('fotoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('previewImg');
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
