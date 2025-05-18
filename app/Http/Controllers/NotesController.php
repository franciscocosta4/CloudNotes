<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use App\Models\SavedNote;
use App\Models\Point;
use App\Models\Subject;
use App\Models\NotesAccessLog;
use App\Models\NoteLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends Controller
{
    public function show($slug)
    {
        $note = Note::where('slug', $slug)->firstOrFail();

        $log = NotesAccessLog::where('user_id', Auth::id())
            ->where('note_id', $note->id)
            ->first();

        $hasLiked = NoteLike::where('user_id', auth()->id()) // var que verifica se o user deu like, para que depois se mude o estilo do buttom
            ->where('note_id', $note->id)
            ->exists();

        $hasSaved = SavedNote::where('user_id', auth()->id()) // var que verifica se o user guardou, para que depois se mude o estilo do buttom
            ->where('note_id', $note->id)
            ->exists();

        $likesCount = $note->likes()->count();

        //* Registra/atualiza o acesso a uma anotação
        if (Auth::check()) {
            if ($log) { //* se o user já tiver acedido pelo menos uma vez apenas atualiza o campo updated_at
                $log->touch(); //atualiza o campo updated_at
            } else { //* se for a primeira vez cria um registo na bd 
                NotesAccessLog::updateOrCreate(
                    [
                        'user_id' => Auth::id(),
                        'note_id' => $note->id,
                    ],
                    ['created_at' => now()] // cria um registro na bd
                );
            }
        }

        return view('notes.show', compact('note', 'hasLiked', 'hasSaved', 'likesCount'));
    }


    public function index()
    {
        if (Auth::check()) {
            //* Recupera todas as anotações do user logado
            $notes = Note::where('user_id', Auth::id())->get();
        } else {
            return redirect()->route('login');
        }
        // Passa a variável $notes para a view
        return view('dashboard', compact('notes'));
    }


    public function createNote()
    {
        return view('notes.create');
    }

    //? Armazenar uma nova anotação e atribuir pontos ao user
    public function storeNote(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'topic_difficulty' => 'required|string|max:255',
            'content' => 'nullable|string', // Conteúdo é opcional
            'file_path' => 'nullable|file|mimes:pdf',   // Arquivo é opcional
        ], [
            'content.required_without' => 'Você precisa fornecer o conteúdo ou carregar um arquivo.',
            'file_path.required_without' => 'Você precisa fornecer o conteúdo ou carregar um arquivo.',
        ]);

        $filePath = null;
        if ($request->hasFile('file_path')) {
            //* Salve o arquivo e obtenha o caminho
            $filePath = $request->file('file_path')->store('notes', 'public');
        }

        //* Criação da nota
        $note = Note::create([
            'user_id' => auth()->id(), //* Associando ao user autenticado
            'title' => $request->title,
            'subject' => $request->subject,
            'topic_difficulty' => $request->topic_difficulty,
            'content' => $request->content,
            'file_path' => $filePath,
        ]);

        //* Adicionar pontos ao user
        $user = Auth::user();
        if ($user) {
            $pointsEarned = 500; // Aqui são definidos os pontos q cada publicação dá

            //* Registra os pontos na tabela 'points'
            Point::create([
                'user_id' => $user->id,
                'points' => $pointsEarned,
                'type' => 'upload',
            ]);

            //* Atualiza a pontuação total do user na tabela 'users'
            $user->increment('points', $pointsEarned);
        }

        return redirect()->route('dashboard')->with('success', 'Anotação criada com sucesso!');
    }

    public function destroyNote(Note $note)
    {
        $note->delete();
        return redirect()->route('dashboard')->with('success', 'Anotação excluída com sucesso!');
    }

    //* FUNÇÃO PARA O UPLOAD DE IMAGENS NA TEXTAREA(CKEDITOR)
    public function uploadImage(Request $request)
    {
        //*Basicamente A rota e o controlador no Laravel servem apenas para receber o 
        //* ficheiro da imagem, guardá-lo no servidor, e devolver a URL para que o CKEditor a possa inserir automaticamente no conteúdo.


        // Validação: verifica se existe um ficheiro e se este é uma imagem válida
        $request->validate([
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Obter o ficheiro enviado (a key 'upload' é usada pelo CKEditor 5)
        $image = $request->file('upload');

        // Gerar um nome único para o ficheiro
        $imageName = time() . '.' . $image->getClientOriginalExtension();

        // Mover o ficheiro para a pasta 'public/uploads'
        $image->move(public_path('uploads'), $imageName);

        // Gerar o URL de acesso à imagem
        $url = asset('uploads/' . $imageName);

        // Responder com JSON no formato esperado pelo CKEditor 5
        return response()->json([
            'url' => $url
        ]);
    }
    public function likeNote($noteId)
    {
        $user = Auth::user(); // utilizador que está a dar o like

        // Verifica se o user já deu like
        $existing = NoteLike::where('user_id', $user->id)
            ->where('note_id', $noteId)
            ->first();

        if ($existing) {
            // Remove o like (se já existia)
            $existing->delete();

            // Opcional: aqui podes implementar a remoção dos pontos, se quiseres

            return redirect()->to(url()->previous() . '#note-actions-form-' . $noteId);
        } else {
            // Cria o like
            NoteLike::create([
                'user_id' => $user->id,
                'note_id' => $noteId,
            ]);

            // Dá 100 pontos ao user que deu like
            $pointsForLiker = 100;
            Point::create([
                'user_id' => $user->id,
                'points' => $pointsForLiker,
                'type' => 'like',
            ]);
            $user->increment('points', $pointsForLiker);

            // Obtém a nota e o dono da nota
            $note = Note::findOrFail($noteId);
            $noteOwner = User::find($note->user_id);

            // Dá 250 pontos ao dono da nota, se for diferente do user que deu like
            if ($noteOwner->id !== $user->id) {
                $pointsForOwner = 250;
                Point::create([
                    'user_id' => $noteOwner->id,
                    'points' => $pointsForOwner,
                    'type' => 'like_received',
                ]);
                $noteOwner->increment('points', $pointsForOwner);
            }

            return redirect()->to(url()->previous() . '#note-actions-form-' . $noteId);
        }
    }


    public function saveNote($noteId)
    {

        $user = Auth::user();


        //verifica se o user já deu like 
        $existing = SavedNote::where('user_id', $user->id)
            ->where('note_id', $noteId)
            ->first();

        if ($existing) {

            $existing->delete();

            return redirect()->to(url()->previous() . '#note-actions-form-' . $noteId);

        } else {
            SavedNote::create([
                'user_id' => $user->id,
                'note_id' => $noteId,
            ]);


            return redirect()->to(url()->previous() . '#note-actions-form-' . $noteId); //* dá scroll automatico outravez para o botao de like

        }
    }
    public function RemoveSavedNote($noteId)
    {
        $user = Auth::user();

        // Tenta encontrar a nota guardada associada ao utilizador e à nota
        $savedNote = SavedNote::where('user_id', $user->id)
            ->where('note_id', $noteId)
            ->first();

        // Verifica se a nota foi encontrada
        if (!$savedNote) {
            return redirect()->route('saved.notes.index')->with('error', 'Nota não encontrada.');
        }

        // Caso a nota tenha sido encontrada, apaga-a
        $savedNote->delete();

        return redirect()->route('saved.notes.index')->with('success', 'Anotação excluída com sucesso!');
    }


    public function IndexSavedNotes()
    {

        $user = Auth::user();

        if (Auth::check()) {
            $savedNoteIds = SavedNote::where('user_id', $user->id)->pluck('note_id');

            $SavedNotes = Note::whereIn('id', $savedNoteIds)->get();

        } else {
            return redirect()->route('login');
        }


        //? Recupera as anotações publicadas pelo user (PARA GARANTIR QUE AS ANOTAÇÕES PUBLICADAS PELO USER AINDA APARECEM NA PAGINA )
        $notes = Note::where('user_id', Auth::id())->get();

        //* AS ACCESSLOGS SAO REGISTADAS NO NotesController nao aqui

        //* isto é para mostrar na pagina do user, nao na tabela do admin, as accessLogs para a do admin estao declaradas no adminController
        //? a var $accessLogs também é declarada no SearchController por isso sempre que se mudar aqui algo tb tem de se mudar lá
        $accessLogs = NotesAccessLog::where('user_id', auth()->id())
            ->with('note')
            ->orderBy('updated_at', 'desc') //* ORDENAR POR ULTIMA DATA DE ACESSO MAS POR ORDEM DECRESCENTE
            ->get();

        return view('SavedNotes.index', compact('SavedNotes', 'notes', 'accessLogs'));

    }
}
