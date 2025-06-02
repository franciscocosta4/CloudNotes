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
        :root {
            --primary-color: #5D78FF;
            --secondary-color: #1E1E2D;
            --accent-color: #FD397A;
            --light-color: #F4F7FC;
            --text-color: #6C7293;
            --text-dark: #3F4254;
        }
        
        body {
            background-color: var(--light-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            width: 450px;
            padding: 3rem;
            background: white;
            border-radius: 0.42rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
            border: 1px solid #EBEDF3;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .login-header h2 {
            color: var(--secondary-color);
            font-weight: 600;
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }
        
        .login-header i {
            color: var(--primary-color);
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
        }
        
        .form-label {
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        .form-control {
            border-radius: 0.42rem;
            border: 1px solid #EBEDF3;
            padding: 0.75rem 1rem;
            height: calc(1.5em + 1.5rem);
            color: var(--text-color);
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(93, 120, 255, 0.25);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            font-weight: 600;
            padding: 0.75rem;
            border-radius: 0.42rem;
            transition: all 0.3s;
            letter-spacing: 0.5px;
        }
        
        .btn-primary:hover {
            background-color: #4A63FF;
            transform: translateY(-2px);
        }
        
        .btn-block {
            width: 100%;
        }
        
        .form-footer {
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
        }
        
        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .form-footer a:hover {
            color: var(--accent-color);
        }
        
        .input-group-text {
            background-color: #F4F7FC;
            border: 1px solid #EBEDF3;
            color: var(--text-color);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <i class="fas fa-user-shield"></i>
            <h2>Painel Administrativo</h2>
        </div>
        
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="mb-4">
                <label for="email" class="form-label">E-mail</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Seu e-mail" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Sua senha" required>
                </div>
            </div>
            
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-sign-in-alt me-2"></i> Entrar
                </button>
            </div>
            
       
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('admin/assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script>
</body>
</html>