<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – CRM Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background: linear-gradient(135deg, #343a40, #495057); min-height: 100vh; display: flex; align-items: center; }
        .login-card { border: none; border-radius: 16px; box-shadow: 0 10px 40px rgba(0,0,0,0.3); }
        .login-header { background: #343a40; border-radius: 16px 16px 0 0; color: white; padding: 30px; text-align: center; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <div class="login-header">
                    <i class="bi bi-building fs-1"></i>
                    <h4 class="mt-2 mb-0">CRM Laravel</h4>
                    <small class="text-muted">Inicia sesión para continuar</small>
                </div>
                <div class="card-body p-4">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle"></i>
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}" placeholder="tu@email.com" required autofocus>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                            </div>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Recordarme</label>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
                        </button>
                    </form>

                    <hr>
                    <div class="text-center small text-muted">
                        <strong>Usuarios de prueba:</strong><br>
                        Admin: admin@crm.com / password<br>
                        Usuario: usuario@crm.com / password
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
