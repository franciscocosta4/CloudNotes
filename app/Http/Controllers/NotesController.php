<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\Point; 
use App\Models\NotesAccessLog; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function show($slug)
    {
        $note = Note::where('slug', $slug)->firstOrFail();
    
        //* Registra/atualiza o acesso a uma anotação
        if (Auth::check()) {
            NotesAccessLog::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'note_id' => $note->id,
                ],
                ['created_at' => now()] //* Atualiza a data de acesso
            );
        }
    
        return view('notes.show', compact('note'));
    }
    
    
    public function index()
    {
        if (Auth::check()) {
            //* Recupera todas as anotações do user logado
            $notes = Note::where('user_id', Auth::id())->get();
        } else {
            return redirect()->route('login');
        }
        // Passa a variável $notes para a view
        return view('dashboard', compact('notes'));
    }
    

    public function createNote()
    {
        return view('notes.create');
    }
    
    //? Armazenar uma nova anotação e atribuir pontos ao user
    public function storeNote(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'subject'          => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content'          => 'nullable|string', // Conteúdo é opcional
            'file_path'        => 'nullable|file|mimes:zip,rar',   // Arquivo é opcional
        ], [
            'content.required_without'   => 'Você precisa fornecer o conteúdo ou carregar um arquivo.',
            'file_path.required_without' => 'Você precisa fornecer o conteúdo ou carregar um arquivo.',
        ]);

        $filePath = null;
        if ($request->hasFile('file_path')) {
            //* Salve o arquivo e obtenha o caminho
            $filePath = $request->file('file_path')->store('notes', 'public');
        }
        
        //* Criação da nota
        $note = Note::create([
            'user_id'          => auth()->id(), //* Associando ao user autenticado
            'title'            => $request->title,
            'subject'          => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,   
            'content'          => $request->content,
            'file_path'        => $filePath,
        ]);

        //* Adicionar pontos ao user
        $user = Auth::user();
        if ($user) {
            $pointsEarned = 500; // Aqui são definidos os pontos q cada publicação dá

            //* Registra os pontos na tabela 'points'
            Point::create([
                'user_id' => $user->id,
                'points'  => $pointsEarned,
                'type'    => 'upload',
            ]);

            //* Atualiza a pontuação total do user na tabela 'users'
            $user->increment('points', $pointsEarned);
        }

        return redirect()->route('dashboard')->with('success', 'Anotação criada com sucesso!');
    }

    public function destroyNote(Note $note)
    {
        $note->delete();
        return redirect()->route('dashboard')->with('success', 'Anotação excluída com sucesso!');
    }
}
