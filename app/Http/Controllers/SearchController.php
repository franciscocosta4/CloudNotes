<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Realiza uma pesquisa nas notas.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function searchNotes(Request $request)
    {
        // Validação para garantir que um termo foi fornecido
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        // Captura o termo de busca
        $query = $request->input('query');

        // Realiza a pesquisa usando Laravel Scout
        $results = Note::search($query)->get();

        // Retorna a view com os resultados
        return view('dashboard', [
            'results' => $results,
            'query' => $query,
        ]);
    }
}
