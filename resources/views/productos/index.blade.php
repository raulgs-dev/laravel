@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-box-seam text-success"></i> Productos</h2>
    <a href="{{ route('productos.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Nuevo Producto
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="tablaProductos" class="table table-hover align-middle w-100">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>PDF</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td>
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" class="table-img" alt="Imagen">
                        @else
                            <div class="table-img bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-image text-muted"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $producto->nombre }}</td>
                    <td><span class="badge bg-success">{{ number_format($producto->precio, 2) }} €</span></td>
                    <td>{{ $producto->cantidad }}</td>
                    <td>
                        @if($producto->pdf)
                            <a href="{{ asset('storage/' . $producto->pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-file-pdf"></i> PDF
                            </a>
                        @else
                            <span class="text-muted">–</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('productos.show', $producto) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if(auth()->user()->esAdmin())
                        <form action="{{ route('productos.destroy', $producto) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $productos->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tablaProductos').DataTable({
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' },
            pageLength: 10,
            order: [[0, 'desc']],
            columnDefs: [{ orderable: false, targets: [1, 5, 6] }]
        });
    });
</script>
@endpush
