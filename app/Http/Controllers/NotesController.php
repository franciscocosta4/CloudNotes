<?php
namespace App\Http\Controllers;

use App\Models\Note; 
use App\Models\User; 
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
    

   //* Armazenar uma nova anotação e atribuir pontos ao user.

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
        Note::create([
            'user_id'          => auth()->id(), //* Associando ao user autenticado
            'title'            => $request->title,
            'subject'          => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,
            'content'          => $request->content,
            'file_path'        => $filePath,
        ]);

        $userId = auth()->id(); //* Obtém o ID do user autenticado
        if ($userId) {
            $user = User::find($userId);
            $user->points += 500; //* Soma 1000 aos pontos existentes
            $user->save();
        }
        

        return redirect()->route('dashboard')->with('success', 'Anotação criada com sucesso!');
    }

    //* EXIBIR  A VIEW DE EDIÇAO 
    // public function editNote(Note $note)
    // {
    //     return view('notes.edit', compact('note'));
    // }

    //*EDITAR UMA ANOTAÇAO 
    // public function updateNote(Request $request, Note $note)
    // {
    //     $request->validate([
    //         'title'            => 'required|string|max:255',
    //         'subject'          => 'required|string|max:255',
    //         'topic_difficulty' => 'required|string|max:255',
    //         'content'          => 'nullable|string',
    //         'file_path'        => 'nullable|file',
    //     ]);

    //     $filePath = $request->file('file_path')
    //     ? $request->file('file_path')->store('notes', 'public')
    //     : null;

    //     $note->update([
    //         'title'            => $request->title,
    //         'subject'          => $request->subject,
    //         'topic_difficulty' => $request->topic_difficulty,
    //         'content'          => $request->content,
    //         'file_path'        => $filePath,
    //     ]);

    //     return redirect()->route('dashboard')->with('success', 'Anotação atualizada com sucesso!');
    // }

    /**
     * Excluir uma anotação.
     */
    public function destroyNote(Note $note)
    {
        $note->delete();
        return redirect()->route('dashboard')->with('success', 'Anotação excluída com sucesso!');
    }

}
