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
        // Captura o termo de busca
        $query = $request->input('query');

        // Captura o filtro de disciplina, se fornecido
        $disciplina = $request->input('disciplina');
        

        // Captura o filtro de dificuldade, se fornecido
        $dificuldade = $request->input('dificuldade');

        // Inicializa a query do modelo Note
        $results = Note::query();

        if (!empty($query)) {
            // Aplica a busca pelo termo, caso fornecido
            $results->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            });
        }

        if (!empty($disciplina)) {
            // Aplica o filtro de disciplina
            $results->where('subject', $disciplina);
        }
        if (!empty($dificuldade)) {
            // Aplica o filtro de disciplina
            $results->where('topic_difficulty', $dificuldade);
        }


        // Executa a consulta e obtém os resultados
        $results = $results->get();

        return view('dashboard', [
            'results' => $results,
            'query' => $query,
            'disciplina' => $disciplina, 
            'dificuldade' =>$dificuldade,
        ]);
    }
}
