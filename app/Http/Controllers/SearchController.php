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
            $results->where('content', 'like', "%{$query}%"); // Altere 'content' para o campo desejado
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

        // Retorna a view com os resultados e os parâmetros usados
        return view('dashboard', [
            'results' => $results,
            'query' => $query,
            'disciplina' => $disciplina, // Isso será `null` se `disciplina` não for fornecida
            'dificuldade' =>$dificuldade,
        ]);
    }
}
