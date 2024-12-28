<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */


    //* ESTA É A FUNÇAO QUE REGISTA O UTILIZADOR E OS SEUS DADOS
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'school_year' => ['nullable', 'integer', 'between:7,12'], //  número inteiro entre 7 e 12
            'subjects_of_interest' => ['nullable', 'array'], // Validar como um array
            'subjects_of_interest.*' => ['string', 'in:Matemática,Física,Química,Biologia,Português,História,Geografia,Inglês'], // Validar que cada disciplina seja uma das opções válidas
        ]);
        
        // Criar o usuário com os dados validados
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'school_year' => $request->school_year, // Novo campo
            'subjects_of_interest' => json_encode($request->subjects_of_interest), // Novo campo (armazenado como JSON)
            'points' => 0, // Valor padrão
        ]);
        
    
        event(new Registered($user));
    
        Auth::login($user);
    
        return redirect(route('dashboard', absolute: false));
    }
    
}
