@extends('layout')

@section('content')
<div class="d-flex align-items-center mb-4">
    <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary me-3">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h2 class="mb-0"><i class="bi bi-person text-info"></i> Detalle del Cliente</h2>
</div>

<div class="card">
    <div class="card-body p-4">
        <div class="row">
            <div class="col-md-3 text-center">
                @if($cliente->foto)
                    <img src="{{ asset('storage/' . $cliente->foto) }}"
                         style="width:150px;height:150px;object-fit:cover;border-radius:50%;border:4px solid #dee2e6;">
                @else
                    <div style="width:150px;height:150px;border-radius:50%;background:#6c757d;display:flex;align-items:center;justify-content:center;margin:auto;">
                        <i class="bi bi-person text-white" style="font-size:4rem;"></i>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <h3>{{ $cliente->nombre }}</h3>
                <table class="table">
                    <tr>
                        <th width="150"><i class="bi bi-envelope"></i> Email</th>
                        <td>{{ $cliente->email }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-telephone"></i> Teléfono</th>
                        <td>{{ $cliente->telefono }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-geo-alt"></i> Dirección</th>
                        <td>{{ $cliente->direccion }}</td>
                    </tr>
                    <tr>
                        <th><i class="bi bi-calendar"></i> Registrado</th>
                        <td>{{ $cliente->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>

                <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Editar
                </a>
                @if(auth()->user()->esAdmin())
                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('¿Eliminar este cliente?')">
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
