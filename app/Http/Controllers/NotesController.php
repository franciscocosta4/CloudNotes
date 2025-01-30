<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\Point; // Importamos o modelo de pontos
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function show($slug)
    {
        //* Encontrar a nota pelo slug
        $note = Note::where('slug', $slug)->firstOrFail();

        //* Retorna a visão de show passando a nota
        return view('notes.show', compact('note'));
    }

    public function createNote()
    {
        return view('notes.create');
    }
    
    //* Armazenar uma nova anotação e atribuir pontos ao user
    public function storeNote(Request $request)
    {
        $request->validate([
            'title'            => 'required|string|max:255',
            'subject'          => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content'          => 'nullable|string', // Conteúdo é opcional
            'file_path'        => 'nullable|file',   // Arquivo é opcional
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
            $pointsEarned = 500; // Definição de pontos por publicação

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

    /**
     * Excluir uma anotação.
     */
    public function destroyNote(Note $note)
    {
        $note->delete();
        return redirect()->route('dashboard')->with('success', 'Anotação excluída com sucesso!');
    }
}
