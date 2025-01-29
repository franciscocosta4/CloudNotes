<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Função de login
    public function login(Request $request)
    {
        // Valida as credenciais
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tenta autenticar o usuário com as credenciais
        if (Auth::attempt($credentials)) {
            // Regenera a sessão para maior segurança
            $request->session()->regenerate();

            // Verifica a role do usuário após o login
            if (Auth::user()->role === 'admin') {
                // Se for admin, redireciona para o painel de administração
                return redirect()->route('admin.dashboard');
            } else {
                // Se não for admin, redireciona para a dashboard normal
                return redirect()->route('dashboard');
            }
        }

        // Se as credenciais forem inválidas, retorna um erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não são válidas.',
        ]);
    }

    // Exibe o formulário de login
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Logout do usuário
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
