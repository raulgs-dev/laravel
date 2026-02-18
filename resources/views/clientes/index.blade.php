@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people text-primary"></i> Clientes</h2>
    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Cliente
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table id="tablaClientes" class="table table-hover align-middle w-100">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                <tr>
                    <td>{{ $cliente->id }}</td>
                    <td>
                        @if($cliente->foto)
                            <img src="{{ asset('storage/' . $cliente->foto) }}" class="table-img" alt="Foto">
                        @else
                            <div class="table-img bg-secondary d-flex align-items-center justify-content-center">
                                <i class="bi bi-person text-white"></i>
                            </div>
                        @endif
                    </td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->email }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ Str::limit($cliente->direccion, 40) }}</td>
                    <td>
                        <a href="{{ route('clientes.show', $cliente) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        @if(auth()->user()->esAdmin())
                        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar este cliente?')">
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

        {{-- Paginación Laravel --}}
        <div class="d-flex justify-content-center mt-3">
            {{ $clientes->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#tablaClientes').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            },
            pageLength: 10,
            order: [[0, 'desc']],
            columnDefs: [{ orderable: false, targets: [1, 6] }]
        });
    });
</script>
@endpush
