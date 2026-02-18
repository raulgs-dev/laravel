@extends('layout')

@section('content')
<div class="text-center py-5">
    <i class="bi bi-shield-exclamation text-danger" style="font-size: 5rem;"></i>
    <h1 class="display-4 mt-3">403</h1>
    <h2>Acceso Denegado</h2>
    <p class="text-muted">No tienes permisos para realizar esta acción. Solo los administradores pueden hacerlo.</p>
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-2">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>
@endsection
