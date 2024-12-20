<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            // Redirecione para o painel de administradores
            return redirect()->route('admin.dashboard');
        }
    
        // Retorna um erro se o login falhar
        return back()->withErrors([
            'email' => 'As credenciais fornecidas não são válidas.',
        ]);
    }
    

    public function showLoginForm()
    {
        // Retorna a view de login específica para admin
        return view('admin.auth.login');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
