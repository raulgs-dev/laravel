<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi CRM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">CRM Laravel</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('clientes.index') }}">Clientes</a>
                </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>