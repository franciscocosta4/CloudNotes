<!-- resources/views/search.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Resultados para "{{ $query }}"</h1>

    @if($results->isEmpty())
        <p>Nenhum resultado encontrado.</p>
    @else
        <ul>
            @foreach($results as $note)
                <li>
                    <a href="{{ route('notes.show', $note->slug) }}">
                        <h3>{{ $note->title }}</h3>
                        <p>{{ $note->subject }}</p>
                        <p><strong>Dificuldade:</strong> {{ $note->topic_difficulty }}</p>

                        <!-- Verifica se o usuário existe antes de acessar o nome -->
                        <p><strong>Utilizador:</strong> {{ $note->user ? $note->user->name : 'Desconhecido' }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
