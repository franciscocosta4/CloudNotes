<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    //? Ver ProfileUpdateRequest.php caso queira editar
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
    
        //* PERMITE ATUALIZAR O ANO ESCOLAR E AS DISCIPLINAS 
        $user->fill(array_merge(
            $request->validated(),
            [
                'school_year' => $request->input('school_year'),
                'subjects_of_interest' => json_encode($request->input('subjects_of_interest')),
            ]
        ));
    
        //* Verifique se o e-mail foi alterado e limpe a verificação se necessário
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        $user->save();
    
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
