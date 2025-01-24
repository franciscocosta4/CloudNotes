<!-- resources/views/note/show.blade.php -->
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<style>


.main-content {
    display: flex;
    margin:auto;
    justify-content: center;
    align-items: center;
     flex-direction: column;
    width: 95%;
    max-width:none;
    text-align: center;
    margin-bottom: 1.5rem;
}
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $note->title }}</title>
</head>
<body>
    <br>
    <div class="main-content">
    <p><strong>Disciplina:</strong> {{ $note->subject }}</p>
    <p><strong>Utilizador:</strong> {{ $note->user->name }}</p>
    <p><strong>Dificuldade:</strong> {{ $note->topic_difficulty }}</p>
    <br>
    <div>
    <h1>{{ $note->title }}</h1> 
    <br>
        @if (!empty($note->content))
            <p>{{ $note->content }}</p>
        @else
            <p>Não há conteúdo disponível para esta anotação.</p>
        @endif
    </div>
    </div>
    <a href="{{ Storage::url($note->file_path) }}" download="{{ $note->title }}.{{ pathinfo($note->file_path, PATHINFO_EXTENSION) }}">Transferir Anotação</a>

    <button id="back-button" class="btn btn-secondary"  onclick="window.history.back()">Voltar</button>
</body>
</html>
