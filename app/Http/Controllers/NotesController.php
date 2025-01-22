<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; // Certifique-se de importar o Auth
use Illuminate\Support\Facades\Storage;
use App\Models\Note;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function show($slug)
    {
        // Encontrar a nota pelo slug
        $note = Note::where('slug', $slug)->firstOrFail();

        // Retornar a visão de show passando a nota
        return view('notes.show', compact('note'));
    }

    public function createNote()
    {
        return view('notes.create');
    }

    /**
     * Armazenar uma nova anotação.
     */
    public function storeNote(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content' => 'nullable|string', // Conteúdo é opcional
            'file_path' => 'nullable|file', // Arquivo é opcional
        ], [
            'content.required_without' => 'Você precisa fornecer o conteúdo ou carregar um arquivo.',
            'file_path.required_without' => 'Você precisa fornecer o conteúdo ou carregar um arquivo.',
        ]);
    
        $filePath = null;
        if ($request->hasFile('file_path')) {
            // Salve o arquivo e obtenha o caminho
            $filePath = $request->file('file_path')->store('notes', 'public');
        }
    
        // Criação da nota
        Note::create([
            'user_id' => auth()->id(), // Associando ao usuário autenticado
            'title' => $request->title,
            'subject' => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,
            'content' => $request->content,
            'file_path' => $filePath,
        ]);
    
        return redirect()->route('dashboard')->with('success', 'Anotação criada com sucesso!');
    }
    
    

    /**
     * Exibir o formulário para editar uma anotação existente.
     */
    public function editNote(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Atualizar uma anotação existente.
     */
    public function updateNote(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file_path' => 'nullable|file',
        ]);

        $filePath = $request->file('file_path') 
        ? $request->file('file_path')->store('notes', 'public') 
        : null;
    

        $note->update([
            'title' => $request->title,
            'subject' => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,
            'content' => $request->content,
            'file_path' => $filePath,
        ]);

        return redirect()->route('dashboard')->with('success', 'Anotação atualizada com sucesso!');
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