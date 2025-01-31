<?php
namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Captura a query e os filtros
        $query = $request->input('query');
        $disciplina = $request->input('disciplina');
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
            $results->where('subject', $disciplina);
        }
        if (!empty($dificuldade)) {
            $results->where('topic_difficulty', $dificuldade);
        }

        //* Executa a consulta e obtém os resultados
        $results = $results->get();

        //? Recupera as anotações publicadas pelo user (PARA GARANTIR QUE AS ANOTAÇÕES DA SIDEBAR AINDA FICAM LÁ ) 
        $notes = Note::where('user_id', Auth::id())->get();


        return view('dashboard', [
            'results' => $results,
            'notes' => $notes,
            'query' => $query,
            'disciplina' => $disciplina, 
            'dificuldade' =>$dificuldade,
        ]);
    }
}
