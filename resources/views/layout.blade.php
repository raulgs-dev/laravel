<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Laravel</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- DataTables --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: bold; }
        .sidebar { min-height: calc(100vh - 56px); background: #343a40; }
        .sidebar .nav-link { color: #adb5bd; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background: rgba(255,255,255,0.1); border-radius: 6px; }
        .sidebar .nav-link i { margin-right: 8px; }
        .content-wrapper { padding: 20px; }
        .card { border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .table-img { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('clientes.index') }}">
            <i class="bi bi-building"></i> CRM Laravel
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="bi bi-person-circle"></i>
                            {{ auth()->user()->name }}
                            <span class="badge {{ auth()->user()->esAdmin() ? 'bg-danger' : 'bg-secondary' }} ms-1">
                                {{ ucfirst(auth()->user()->rol) }}
                            </span>
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white">
                                <i class="bi bi-box-arrow-right"></i> Salir
                            </button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        @auth
        {{-- Sidebar --}}
        <div class="col-md-2 sidebar py-3">
            <nav class="nav flex-column px-2">
                <a class="nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}"
                   href="{{ route('clientes.index') }}">
                    <i class="bi bi-people"></i> Clientes
                </a>
                <a class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}"
                   href="{{ route('productos.index') }}">
                    <i class="bi bi-box-seam"></i> Productos
                </a>
                <a class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}"
                   href="{{ route('proveedores.index') }}">
                    <i class="bi bi-truck"></i> Proveedores
                </a>
                <a class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}"
                   href="{{ route('empleados.index') }}">
                    <i class="bi bi-person-badge"></i> Empleados
                </a>
                <a class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}"
                   href="{{ route('categorias.index') }}">
                    <i class="bi bi-tags"></i> Categorías
                </a>
            </nav>
        </div>
        @endauth

        {{-- Contenido --}}
        <div class="{{ auth()->check() ? 'col-md-10' : 'col-12' }} content-wrapper">

            {{-- Alertas --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

@stack('scripts')

</body>
</html>
