<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
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
        $allSubjects = Subject::all();
        return view('auth.register', compact('allSubjects'));
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
        'school_year' => ['nullable', 'integer', 'between:7,12'], 
        'subjects_of_interest' => ['nullable', 'array'], 
        'subjects_of_interest.*' => ['integer', 'exists:subjects,id'], // Agora usa IDs da tabela `subjects`
    ]);


    // Criar o utilizador
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'school_year' => $request->school_year,
        'points' => 0,
    ]);

    // Associar disciplinas de interesse na tabela pivô
    if ($request->has('subjects_of_interest')) {
        $user->subjects()->attach($request->subjects_of_interest);
    }

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false));
}

    
}
