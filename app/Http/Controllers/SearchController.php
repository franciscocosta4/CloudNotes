<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\NotesAccessLog;
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
        //* Captura a query e os filtros
        $query = $request->input('query');
        $disciplina = $request->input('disciplina');
        $dificuldade = $request->input('dificuldade');

        //* Inicializa a query do modelo Note
        $results = Note::query();

        if (!empty($query)) {
            //* Aplica a busca pelo termo, caso fornecido
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

        //! METODO orderBy() VAI SER USADO QUANDO FOR PARA ORDENAR POR LIKES
        // $results = $results->orderBy('likes')->get(); 

        //* Executa a consulta e obtém os resultados
        $results = $results->get();

        //? Recupera as anotações publicadas pelo user e o histórico de acesso (PARA GARANTIR QUE AS ANOTAÇÕES DA SIDEBAR AINDA FICAM LÁ ) 
        $notes = Note::where('user_id', Auth::id())->get();
        $accessLogs = NotesAccessLog::where('user_id', auth()->id())->with('note')->get();

        return view('dashboard', [
            'results' => $results,
            'notes' => $notes,
            'accessLogs' => $accessLogs,
            'query' => $query,
            'disciplina' => $disciplina,
            'dificuldade' => $dificuldade,
        ]);
    }

    public function adminSearch(Request $request)
    {
        //* Captura a query 
        $query = $request->input('query');

        $results = [
            'notes' => Note::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->orWhere('subject', 'like', "%{$query}%")
                ->orWhereHas('user', function ($q) use ($query) {  //* orWhereHas('user', ...) vai incluir todas as notes que pertencem a utilizadores cujo nome, email ou id correspondam à pesquisa.
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('email', 'like', "%{$query}%")
                        ->orWhere('id', 'like', "%{$query}%");
                })->get(),

            'users' => User::where('name', 'like', "%$query%")
                ->orWhere('email', 'like', "%{$query}%")    
                ->orWhere('id', 'like', "%{$query}%")->get(),
        ];

        return view('admin.searchresult', [
            'results' => $results,
            'query' => $query,
        ]);

    }
}
