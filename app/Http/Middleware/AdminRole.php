<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminRole
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se o usuário autenticado tem a role 'admin'
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // Caso contrário, redireciona para o painel de usuário normal
        return redirect('/');
    }
}
