<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $note->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        /* Estilos específicos para a página de leitura */
        .main-content {
            width: 100%;
            max-width: 800px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        .main-content h1 {
            font-size: 1.8rem;
            color: #0F044C;
            margin-bottom: 1.5rem;
        }

        .main-content p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .note-meta {
            margin-bottom: 1.5rem;
        }

        .note-meta p {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 0.5rem;
        }

        .note-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .note-actions a, .note-actions button {
            background-color: #0F044C;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .note-actions a:hover, .note-actions button:hover {
            background-color: #141E61;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="note-meta">
            <p><strong>Disciplina:</strong> {{ $note->subject }}</p>
            <p><strong>Utilizador:</strong> {{ $note->user->name }}</p>
            <p><strong>Dificuldade:</strong> {{ $note->topic_difficulty }}</p>
        </div>
        <h1>{{ $note->title }}</h1>
        @if (!empty($note->content))
            <p>{{ $note->content }}</p>
        @else
            <p>Não há conteúdo disponível para esta anotação.</p>
        @endif
        <div class="note-actions">
            <a href="{{ Storage::url($note->file_path) }}" download="{{ $note->title }}.{{ pathinfo($note->file_path, PATHINFO_EXTENSION) }}">Transferir Anotação</a>
            <button onclick="window.history.back()">Voltar</button>
        </div>
    </div>
</body>
</html>