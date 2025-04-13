<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        // envia para a página de login do google
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
{
    try {
        // Cria o cliente Guzzle que usa o certificado SSl 
        $httpClient = new \GuzzleHttp\Client([
            'verify' => 'c:/wamp64/cacert-2025-02-25.pem', // Caminho do certificado SSL
            'timeout' => 30
        ]);

        // Usa o Guzzle para as operações acossiadas ao driver do google  pois este foi verificado pelo SSL
        $googleUser = Socialite::driver('google')
            ->stateless()
            ->setHttpClient($httpClient) // Aplica o cliente Guzzle
            ->user(); // Chama user() na MESMA instância

        // Verifica se já existe um user registado com o mesmo email
        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            if (empty($user->google_id)) {
                // se houver atualiza o google_id do user
                $user->update(['google_id' => $googleUser->getId()]);
            }
        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)),
                'school_year' => null,
                'points' => 0,
                'role' => 'user'
            ]);
        }

        Auth::login($user, true);
        return redirect()->intended('/dashboard');

    } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
        return redirect()->route('login')->withErrors(['google' => 'Sessão expirada.']);
    } catch (\Exception $e) {
        // \Log::error('Erro no Google OAuth: ' . $e->getMessage());
        // if (env('APP_DEBUG')) dd($e->getMessage(), $e->getTraceAsString());
        return redirect()->route('register')->withErrors(['google' => 'Erro ao conectar com Google: ' . $e->getMessage()]);
    }
}


}
