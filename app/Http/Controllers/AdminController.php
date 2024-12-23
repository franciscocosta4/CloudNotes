<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function dashboard() 
    {
        $users = User::all(); // Pega todos os utilizadors
        $notes = Note::all(); // Pega todas as anotações
        return view('admin.dashboard', compact('users', 'notes'));
    }

    //* CRIAÇÃO DE UTILIZADOR 
    public function createUser()
    {
        return view('admin.users.create'); // Formulário para criar um utilizador
    }

    public function storeUser(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criação do novo utilizador
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Senha criptografada
        ]);

        // Redireciona para o dashboard com uma mensagem de sucesso
        return redirect()->route('admin.dashboard')->with('success', 'utilizador criado com sucesso!');
    }

    //* edição de utilizador
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user')); // Formulário para editar um utilizador
    }
    public function updateUser(Request $request, User $user)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Atualiza o utilizador
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'utilizador atualizado com sucesso!');
    }

    //* Excluir utilizador
    public function destroyUser(User $user)
    {
        // Exclui o utilizador
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'utilizador excluído com sucesso!');
    }


    //*criação de anotação
    public function createNote()
    {
        return view('admin.notes.create'); // Formulário para criar uma anotação
    }
    public function storeNote(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'user_id' => 'required|exists:users,id', // O utilizador precisa existir
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content' => 'required|string',
            'file_path' => 'nullable|string', // Arquivo é opcional
        ]);

        // Criação da nova anotação
        Note::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'subject' => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,
            'content' => $request->content,
            'file_path' => $request->file_path,
        ]);

        // Redireciona para o dashboard com uma mensagem de sucesso
        return redirect()->route('admin.dashboard')->with('success', 'Anotação criada com sucesso!');
    }

    //* edição de anotação
    public function editNote(Note $note)
    {
        return view('admin.notes.edit', compact('note')); // Formulário para editar uma anotação
    }
    public function updateNote(Request $request, Note $note)
    {
        // Validação dos dados de entrada
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content' => 'required|string',
            'file_path' => 'nullable|string', // Arquivo é opcional
        ]);

        // Atualiza a anotação
        $note->update([
            'title' => $request->title,
            'subject' => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,
            'content' => $request->content,
            'file_path' => $request->file_path,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Anotação atualizada com sucesso!');
    }

    //* Excluir anotação
    public function destroyNote(Note $note)
    {
        // Exclui a anotação
        $note->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Anotação excluída com sucesso!');
    }
}
