<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // Se não estiver autenticado, redireciona para a página de login
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('error', 'É necessário autenticação.');
        }

        // Se o utilizador não for admin, redireciona para a home com erro
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
