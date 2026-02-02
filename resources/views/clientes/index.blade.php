@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">Nuevo Cliente</a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->email }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Editar</a>
                    <button class="btn btn-danger btn-sm">Borrar</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection