@extends('layout')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0"><i class="bi bi-box-seam text-success"></i> Detalle del Producto</h2>
</div>

<div class="card">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-4 text-center">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}"
                         style="max-width:100%; max-height:250px; border-radius:12px; object-fit:cover;">
                @else
                    <div style="width:100%;height:200px;background:#e9ecef;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-image text-muted" style="font-size:4rem;"></i>
                    </div>
                @endif
                @if($producto->pdf)
                    <a href="{{ asset('storage/' . $producto->pdf) }}" target="_blank"
                       class="btn btn-danger mt-3 w-100">
                        <i class="bi bi-file-pdf"></i> Descargar Ficha PDF
                    </a>
                @endif
            </div>
            <div class="col-md-8">
                <h3>{{ $producto->nombre }}</h3>
                <table class="table">
                    <tr>
                        <th width="150"><i class="bi bi-currency-euro"></i> Precio</th>
                        <td><span class="badge bg-success fs-6">{{ number_format($producto->precio, 2) }} €</span></td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-stack"></i> Cantidad</th>
                        <td>{{ $producto->cantidad }} unidades</td>
                    </tr>
                    @if($producto->descripcion)
                    <tr>
                        <th><i class="bi bi-card-text"></i> Descripción</th>
                        <td>{{ $producto->descripcion }}</td>
                    </tr>
                    @endif
                    <tr>
                        <th><i class="bi bi-calendar"></i> Creado</th>
                        <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <a href="{{ route('productos.edit', $producto) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                @if(auth()->user()->esAdmin())
                <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('¿Eliminar este producto?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger ms-2">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
