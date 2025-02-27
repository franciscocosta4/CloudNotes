<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <!-- Importação do Bootstrap e do estilo do KaiAdmin -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.min.css') }}">
    <style>
        body {
            background-color: #f4f7fc;
        }
        .login-container {
            width: 400px;
            margin: auto;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            text-align: center;
            font-weight: bold;
        }
        .form-control {
            border-radius: 6px;
            border: 1px solid #ddd;
            padding: 10px;
        }
        .btn-primary {
            background-color: #1E1E2D;
            border: none;
            font-weight: bold;
            padding: 10px;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #3E3E50;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="login-container">
        <h2><i class="fas fa-user-shield"></i> Administrador</h2>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>
</body>
</html>
