<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Subject;
use App\Models\User;
use App\Models\Note;
use App\Models\NoteLike;
use App\Models\SavedNote;
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
    public function public($username): View
    {
        // Busca o usuário pelo campo 'username'
        $user = User::where('username', $username)->firstOrFail();
        $notes = Note::where('user_id', $user->id)->get();
        $notesByLikes = Note::where('user_id', $user->id)
    ->withCount('likes')
    ->orderBy('likes_count', 'desc')
    ->take(6)
    ->get();


        return view('profile.public', compact('user', 'notes', 'notesByLikes'));
    }


    public function show(Request $request): View
    {
        $user = $request->user();
        $notes = Note::where('user_id', Auth::id())->get();
        $savedNoteIds = SavedNote::where('user_id', $user->id)->pluck('note_id');

        $SavedNotes = Note::whereIn('id', $savedNoteIds)->get();

        return view('profile.show', compact('user', 'notes', 'SavedNotes'));
    }
    public function edit(Request $request)
    {
        $user = Auth::user(); // Recupera o usuário autenticado
        $allSubjects = Subject::all(); // Recupera todas as disciplinas para a dropdown
        return view('profile.edit', compact('user', 'allSubjects')); // Passa o usuário e as disciplinas para a view
    }
    public function editAdmin(Request $request)
    {
        $user = Auth::user(); // Recupera o usuário autenticado
        $allSubjects = Subject::all(); // Recupera todas as disciplinas para a dropdown
        return view('admin.profile.edit', compact('user', 'allSubjects')); // Passa o usuário e as disciplinas para a view
    }
    /**
     * Update the user's profile information.
     */
    //? Ver ProfileUpdateRequest.php caso queira editar
    public function update(Request $request)
    {
        $user = Auth::user(); // Recupera o usuário autenticado

        // Validação dos dados
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'school_year' => ['nullable', 'integer', 'between:7,12'],
            'subjects_of_interest' => ['nullable', 'array'],
            'subjects_of_interest.*' => ['integer', 'exists:subjects,id'],
        ]);

        // Atualiza os dados do usuário
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'school_year' => $request->school_year,
        ]);

        // Atualiza as disciplinas de interesse
        if ($request->has('subjects_of_interest')) {
            $user->subjects()->sync($request->subjects_of_interest); // Atualiza as disciplinas de interesse usando sync()
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }


    public function removeSubjectsOfInterest()
    {
        $user = auth()->user();

        // Remove todas as associações na tabela pivot
        $user->subjects()->detach();

        return redirect()->back()->with('success', 'Disciplinas de interesse removidas com sucesso.');
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
