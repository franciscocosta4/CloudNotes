<?php

namespace App\Http\Controllers;

use App\Models\Note;

class NotesController extends Controller
{
    public function show($slug)
    {
        // Encontrar a nota pelo slug
        $note = Note::where('slug', $slug)->firstOrFail();

        // Retornar a visão de show passando a nota
        return view('notes.show', compact('note'));
    }
}
