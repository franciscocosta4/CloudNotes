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

        // Inicializa os resultados com a pesquisa básica
        $results = Note::search($query);

        // Captura o filtro de disciplina, se fornecido
        $disciplina = $request->input('disciplina');

        if (!empty($disciplina)) {
            // Aplica o filtro de disciplina
            $results->where('subject', $disciplina);
        }

        // Executa a consulta e obtém os resultados
        $results = $results->get();

        // Retorna a view com os resultados e os parâmetros usados
        return view('dashboard', [
            'results' => $results,
            'query' => $query,
            'disciplina' => $disciplina, // Isso será `null` se `disciplina` não for fornecida
        ]);
    }
}

