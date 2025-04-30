<?php
namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
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

        return view('notes.show', compact('note', 'hasLiked', 'likesCount'));
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
            'file_path' => 'nullable|file|mimes:zip,rar',   // Arquivo é opcional
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


        $user = Auth::user();
        //verifica se o user já deu like 
        $existing = NoteLike::where('user_id', $user->id)
            ->where('note_id', $noteId)
            ->first();

        //caso tenha dado remove o like 
        if ($existing) {

            $existing->delete();

            return redirect()->to(url()->previous() . '#note-actions-form-' . $noteId);

        } else {
            NoteLike::create([
                'user_id' => $user->id,
                'note_id' => $noteId,
            ]);

            $pointsEarned = 100; //* pontos pelo like  

            //* Registra os pontos na tabela 'points'
            Point::create([
                'user_id' => $user->id,
                'points' => $pointsEarned,
                'type' => 'like',
            ]);

            return redirect()->to(url()->previous() . '#note-actions-form-' . $noteId); //* dá scroll automatico outravez para o botao de like

        }



    }
}
