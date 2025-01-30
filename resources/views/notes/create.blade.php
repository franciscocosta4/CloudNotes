<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partilhar Anotação</title>
    <!-- Preload do Google Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" as="style" onload="this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    </noscript>
    <style>
        body, html {
            font-family: 'Poppins', sans-serif;
            background-color: #F8F9FA;
            color: #444;
            font-size: 13px;
        }

        /* Estilos específicos para a página de partilha */
        .container {
            width: 100%;
            max-width: 1100px;
            margin: 2rem auto;
            padding: 1.5rem;
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: left;
        }

        .container h1 {
            font-size: 1.8rem;
            color: #0F044C;
            margin-bottom: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem; /* Espaçamento entre os campos */
        }

        .form-group.inline {
            display: flex;
            gap: 1rem; /* Espaço entre os campos */
            align-items: flex-end; /* Alinha os campos na parte inferior */
        }

        .form-group.inline .form-control {
            flex: 1; /* Faz os campos ocuparem o espaço disponível */
        }

        .form-label {
            font-size: 1rem;
            color: #0F044C;
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: block;
            width: 130px;
        }

        .form-control {
            width: 95%;
            padding: 0.75rem;
            font-size: 1rem;
            border: 2px solid #DDD;
            border-radius: 8px;
            background-color: #F8F9FA;
            color: #444;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-control:focus {
            border-color: #0F044C;
            box-shadow: 0 0 8px rgba(15, 4, 76, 0.3);
        }

        .text-danger {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .btn {
            background-color: #0F044C;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #141E61;
            transform: scale(1.05);
        }

        #back-button {
            margin-top: 1rem;
            background-color: #6c757d;
        }

        #back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Partilhar Anotação</h1>
        <p>
            Insira os dados do seu resumo:
        </p>
        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title" class="form-label">Título</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group inline">
                <div>
                    <label for="subject" class="form-label">Disciplina</label>
                    <select name="subject" id="subject" class="form-control" required>
                        <option value="Matemática">Matemática</option>
                        <option value="Física">Física</option>
                        <option value="Química">Química</option>
                        <option value="Biologia">Biologia</option>
                        <option value="Português">Português</option>
                        <option value="História">História</option>
                        <option value="Geografia">Geografia</option>
                        <option value="Inglês">Inglês</option>
                    </select>
                </div>
                <div>
                    <label for="topic_difficulty" class="form-label">Dificuldade</label>
                    <select name="topic_difficulty" id="topic_difficulty" class="form-control" required>
                        <option value="Fácil">Fácil</option>
                        <option value="Moderado">Moderado</option>
                        <option value="Difícil">Difícil</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="form-label">Conteúdo</label>
                <p>
            Escreva aqui o conteúdo a seu resumo:
        </p>
                <textarea name="content" id="content" class="form-control" rows="30" required></textarea>
                @if ($errors->has('content') || $errors->has('file_path'))
                    <div class="text-danger">
                        @foreach ($errors->get('content') as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                        @foreach ($errors->get('file_path') as $message)
                            <p>{{ $message }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="file_path" class="form-label">Arquivo (opcional)</label>
                <input type="file" name="file_path" id="file_path" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Partilhar</button>
                <button id="back-button" class="btn" onclick="window.history.back()">Voltar</button>
            </div>
        </form>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function (event) {
            const content = document.getElementById('content').value.trim();
            const file = document.getElementById('file_path').files.length > 0;

            if (!content && !file) {
                event.preventDefault();
                alert('Você deve fornecer um conteúdo ou um arquivo.');
            }
        });
    </script>
</body>
</html>