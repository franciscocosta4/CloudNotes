<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Models\Note;
use App\Models\NotesAccessLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotesAccessLogController extends Controller
{
    public function index()
{
    //? Recupera as anotações publicadas pelo user (PARA GARANTIR QUE AS ANOTAÇÕES PUBLICADAS PELO USER AINDA FICAM LÁ ) 
    $notes = Note::where('user_id', Auth::id())->get();


    $accessLogs = NotesAccessLog::where('user_id', auth()->id())
    ->with('note')
    ->orderBy('created_at', 'desc') //* ORDENAR POR ULTIMA DATA DE ACESSO MAS POR ORDEM DECRESCENTE
    ->get();

    return view('dashboard', compact('accessLogs','notes'));
}
}
