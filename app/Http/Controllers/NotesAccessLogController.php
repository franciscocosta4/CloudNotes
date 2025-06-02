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
    //? Recupera as anotações publicadas pelo user (PARA GARANTIR QUE AS ANOTAÇÕES PUBLICADAS PELO USER AINDA APARECEM NA PAGINA )
    $notes = Note::where('user_id', Auth::id())->get();

    //* AS ACCESSLOGS SAO REGISTADAS NO NotesController nao aqui

    //* isto é para mostrar na pagina do user, nao na tabela do admin, as accessLogs para a do admin estao declaradas no adminController

    $accessLogs = NotesAccessLog::where('user_id', auth()->id()) 
    ->with('note')
    ->orderBy('updated_at', 'desc') //* ORDENAR POR ULTIMA DATA DE ACESSO MAS POR ORDEM DECRESCENTE
    ->get();

    return view('dashboard', compact('accessLogs','notes'));
}
}
