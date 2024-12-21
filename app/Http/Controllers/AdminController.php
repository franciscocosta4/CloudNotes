<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    // Dashboard - Exibe usuários e anotações
    public function dashboard()
    {
        $users = User::all(); // Pega todos os usuários
        $notes = Note::all(); // Pega todas as anotações
        return view('admin.dashboard', compact('users', 'notes'));
    }

    // Formulário de criação de usuário
    public function createUser()
    {
        return view('admin.users.create'); // Formulário para criar um usuário
    }

    // Salvar novo usuário
    public function storeUser(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criação do novo usuário
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Senha criptografada
        ]);

        // Redireciona para o dashboard com uma mensagem de sucesso
        return redirect()->route('admin.dashboard')->with('success', 'Usuário criado com sucesso!');
    }

    // Formulário de edição de usuário
    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user')); // Formulário para editar um usuário
    }

    // Atualizar usuário
    public function updateUser(Request $request, User $user)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Atualiza o usuário
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Excluir usuário
    public function destroyUser(User $user)
    {
        // Exclui o usuário
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Usuário excluído com sucesso!');
    }

    // Formulário de criação de anotação
    public function createNote()
    {
        return view('admin.notes.create'); // Formulário para criar uma anotação
    }

    // Salvar nova anotação
    public function storeNote(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'user_id' => 'required|exists:users,id', // O usuário precisa existir
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

    // Formulário de edição de anotação
    public function editNote(Note $note)
    {
        return view('admin.notes.edit', compact('note')); // Formulário para editar uma anotação
    }

    // Atualizar anotação
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

    // Excluir anotação
    public function destroyNote(Note $note)
    {
        // Exclui a anotação
        $note->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Anotação excluída com sucesso!');
    }
}
