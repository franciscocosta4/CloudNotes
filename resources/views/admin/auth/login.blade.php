<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #0F044C;
            text-align: center;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }
        .form-group input:focus {
            outline: none;
            border-color: #0F044C;
            box-shadow: 0 0 4px rgba(15, 4, 76, 0.2);
        }
        .login-button {
            background-color: #0F044C;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }
        .login-button:hover {
            background-color: #0d0340;
        }
        .login-button:focus {
            outline: none;
            box-shadow: 0 0 4px rgba(15, 4, 76, 0.4);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login de Administrador</h2>
        <form method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="login-button">Entrar</button>
        </form>
    </div>
</body>
</html>
