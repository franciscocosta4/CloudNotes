<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class WelcomeController extends Controller
{
    //
    public function show(Request $request)
    {

        $ip = $request->ip();

        $savedIp = Visit::where('ip_address', $ip)->exists();
        if ($savedIp) {
            return view('welcome');
        } else {
            Visit::create(
                [
                    'ip_address' => $ip,
                ]
            );

            return view('welcome');
        }
    }
}
