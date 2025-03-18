<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AdminLog;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class LogAdminActions
{
    public function handle(Request $request, Closure $next): Response
    {
        // Passa a requisição para o próximo middleware
        $response = $next($request);
        
        // Verifica se a requisição veio do AdminController
        if ($this->isFromAdminController($request)) {
            // Captura a mensagem de sucesso da sessão
            $message = session('success');
            if ($message) {
                AdminLog::create([
                    'admin_id' => Auth::id(),
                    'message'  => $message
                ]);

                //* Remove a mensagem da sessão após registrar para evitar registrar na bd 2 vezes
                session()->forget('success');
            }
        }

        return $response;
    }

    /**
     * Verifica se a requisição veio do AdminController
     *
     * @param Request $request
     * @return bool
     */
    private function isFromAdminController(Request $request): bool
    {
        return str_contains($request->route()->getActionName(), 'AdminController');
    }
}
