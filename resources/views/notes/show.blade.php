<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $note->title }}</title>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" as="style"
        onload="this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&display=swap" rel="stylesheet">

    </noscript>
    <link rel="preload" href="https://fonts.googleapis.com/icon?family=Material+Icons" as="style"
        onload="this.rel='stylesheet'">

    <style>
        body,
        html {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
            color: #444;
            font-size: 14px;
        }

        /* Estilos específicos para a página de leitura */
        .main-content {
            font-family: 'Poppins', sans-serif;
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        .note-content-div {
            border-radius: 12px;
            border: 2px solid rgb(198, 198, 198);
        }

        #note-content {
            margin-left: 10px;
        }

        .main-content h1 {
            font-size: 1.5rem;
            color: #0F044C;
            margin-bottom: 1.2rem;
        }

        .main-content p {
            font-size: 1rem;
            color: #555;
            line-height: 1.6;
            margin-bottom: 1 rem;
        }

        .note-meta {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: row;

        }

        .note-meta p {
            font-size: 0.9rem;
            color: #777;
            margin-bottom: 0.5rem;
            margin-left: 20px;
        }

        .note-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .note-actions a,
        .note-actions button {
            background-color: #0F044C;
            color: white;
            padding: 0.8rem 1.2rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        .note-actions a:hover,
        .note-actions button:hover {
            transform: scale(1.03);
        }
    </style>
</head>

<body>
    <div class="main-content">

        <div class="note-meta">
            <p><strong>Disciplina:</strong> {{ $note->subject }}</p>
            <p><strong>Utilizador:</strong> {{ $result->user?->name ?? 'Utilizador não encontrado' }}</p>
            <p><strong>Dificuldade:</strong> {{ $note->topic_difficulty }}</p>
        </div>
        <h1>{{ $note->title }}</h1>
        <p>Conteúdo da anotação: </p>
        <div class="note-content-div">
            @if (!empty($note->content))
                <p id="note-content">{{ $note->content }}</p>
            @else
                <p>Não há conteúdo disponível para esta anotação.</p>
            @endif
        </div>
        @if (!empty($note->file_path))
            <p>O utilizador submeteu um ficheiro, caso queira transferir clique em 'transferir' </p>
        @else
            <p>Não existe ficheiro disponível para esta anotação.</p>
        @endif
        <div class="note-actions">
            <a href="{{ Storage::url($note->file_path) }}"
                download="{{ $note->title }}.{{ pathinfo($note->file_path, PATHINFO_EXTENSION) }}"
                style="display: flex; align-items: center; gap: 5px;">
                <span class="material-icons">download</span>
                Transferir
            </a>

            <button onclick="window.history.back()">Voltar</button>
        </div>
    </div>
</body>

</html>