<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Visit;

class WelcomeController extends Controller
{
    public function show(Request $request)
    {
        $ip = $request->header('X-Forwarded-For');

        if ($ip) {
            $ip = explode(',', $ip)[0];
        } else {
            $ip = $request->ip();
        }
        if (Visit::where('ip_address', $ip)->exists()) {
            return view('welcome');
        }

        // Chave da API (idealmente guardada no .env)
        $apiKey = env('IPGEOLOCATION_API_KEY');

        // Requisição à API externa
        $response = Http::get('https://api.ipgeolocation.io/ipgeo', [
            'apiKey' => $apiKey,
            'ip' => $ip
        ]);

        if ($response->successful()) {
            $data = $response->json();

            try {
                Visit::create([
                    'ip_address' => $ip,
                    'latitude' => $data['latitude'] ?? null,
                    'longitude' => $data['longitude'] ?? null,
                    'city' => $data['city'] ?? null,
                    'country' => $data['country_name'] ?? null,
                    'visited_at' => now(),
                ]);
            } catch (\Exception $e) {
                \Log::error('Erro ao criar visita: ' . $e->getMessage());
            }

        }


        return view('welcome');
    }
}
