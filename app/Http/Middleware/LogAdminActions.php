<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AdminAction;
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
                AdminAction::create([
                    'admin_id' => Auth::id(),
                    'message'  => $message,
                    'seen'     => false,
                ]);

                //* Remove a mensagem da sessão após registrar para evitar registrar na bd 2 vezes
                // session()->forget('success');
                session()->reflash(); //* mantém a sessão ativa para a próxima requisição, garantindo que o JavaScript no frontend ainda consiga acessar session('success') e exibir o toast.
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
