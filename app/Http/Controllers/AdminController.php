<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Models\NotesAccessLog;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{

    public function dashboard() 
    {
        $users = User::all(); // Pega todos os utilizadors
        $notes = Note::all(); // Pega todas as anotações
        $points = Point::all(); // Pega todas os pontos
        $logs = NotesAccessLog::all();
        $totalUsers = User::count();
        $PublishedNotes= Note::count();
        $ficheiros = Note::whereNotNull('file_path')->latest()->take(5)->with('user')->get();
        // $userName = User::table('users')->where('id', $ficheiro->user_id)->value('name');; 
        return view('admin.dashboard', compact('users', 'notes', 'logs', 'totalUsers', 'PublishedNotes', 'ficheiros','points'));
    }
    

    //* CRIAÇÃO DE UTILIZADOR 
    public function createUser()
    {
        return view('admin.users.create'); // Formulário para criar um utilizador
    }

    public function storeUser(Request $request)
    {
        // Validação dos dados 
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'school_year' => ['nullable', 'integer', 'between:7,12'], //  número inteiro entre 7 e 12
            'subjects_of_interest' => ['nullable', 'array'], // Validar como um array
            'subjects_of_interest.*' => ['string', 'in:Matemática,Física,Química,Biologia,Português,História,Geografia,Inglês'], // Validar que cada disciplina seja uma das opções válidas
            'role' =>  'required|in:user,admin', 
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password), 
            'school_year' => $request->school_year, // Novo campo
            'subjects_of_interest' => json_encode($request->subjects_of_interest), // Novo campo (armazenado como JSON)
            'role' => $request->input('role'),
            'points' => 0, // Valor padrão
        ]);
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
            'school_year' => ['nullable', 'integer', 'between:7,12'], //  número inteiro entre 7 e 12
            'subjects_of_interest' => ['nullable', 'array'], // Validar como um array
            'subjects_of_interest.*' => ['string', 'in:Matemática,Física,Química,Biologia,Português,História,Geografia,Inglês'], // Validar que cada disciplina seja uma das opções válidas
            'role' =>  'required|in:user,admin',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->input('role'),
            'school_year' => $request->school_year, // Novo campo
            'subjects_of_interest' => json_encode($request->subjects_of_interest), // Novo campo (armazenado como JSON),
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'utilizador atualizado com sucesso!');
    }

    //* Excluir utilizador
    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'utilizador excluído com sucesso!');
    }


    //*criação de anotação
    public function createNote()
    {
        return view('admin.notes.create'); 
    }
    public function storeNote(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // O utilizador precisa existir
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content' => 'required|string',
            'file_path' => 'nullable|string', // Arquivo é opcional
        ]);
        Note::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'subject' => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,
            'content' => $request->content,
            'file_path' => $request->file_path,
        ]);
        return redirect()->route('admin.dashboard')->with('success', 'Anotação criada com sucesso!');
    }

    //* edição de anotação
    public function editNote(Note $note)
    {
        return view('admin.notes.edit', compact('note')); // Formulário para editar uma anotação
    }
    public function updateNote(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content' => 'required|string',
            'file_path' => 'nullable|string', 
        ]);
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
        $note->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Anotação excluída com sucesso!');
    }


     //* Excluir log de acesso
     public function destroyLog(NotesAccessLog $log)
     {
         $log->delete();
         return redirect()->route('admin.dashboard')->with('success', 'log de acesso excluída com sucesso!');
     }

     //* Excluir log de pontos
     public function destroyPoint(Point $point)
     {
         $point->delete();
         return redirect()->route('admin.dashboard')->with('success', 'log de pontos excluída com sucesso!');
     }
}
