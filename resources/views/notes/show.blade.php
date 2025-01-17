<!-- resources/views/note/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $note->title }}</title>
</head>
<body>
    <h1>{{ $note->title }}</h1>
    <p><strong>Disciplina:</strong> {{ $note->subject }}</p>
    <p><strong>Utilizador:</strong> {{ $note->user->name }}</p>
    <p><strong>Dificuldade:</strong> {{ $note->topic_difficulty }}</p>

    <div>
        <h2>Conteúdo da Anotação</h2>
        <p>{{ $note->content }}</p>
    </div>

    <a href="{{ asset('path/to/notes/' . $note->file_path) }}" download>Transferir Anotação</a>

    <button onclick="window.history.back()">Voltar</button>
</body>
</html>
