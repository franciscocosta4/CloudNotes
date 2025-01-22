<!-- Preload do estilo local -->
<link rel="preload" href="{{ asset('css/style.css') }}" as="style" onload="this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</noscript>

<!-- Preload do Google Fonts -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" as="style" onload="this.rel='stylesheet'">
<noscript>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</noscript>

<div class="container">
    <h1>Criar Anotação</h1>
    <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
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
        <div class="mb-3">
            <label for="topic_difficulty" class="form-label">Dificuldade</label>
            <select name="topic_difficulty" id="topic_difficulty" class="form-control" required>
                <option value="Fácil">Fácil</option>
                <option value="Moderado">Moderado</option>
                <option value="Difícil">Difícil</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Conteúdo</label>
            <textarea name="content" id="content" class="form-control" rows="5">{{ old('content') }}</textarea>
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
        <div class="mb-3">
            <label for="file_path" class="form-label">Arquivo (opcional)</label>
            <input type="file" name="file_path" id="file_path" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
</div>
<button id="back-button" class="btn btn-secondary" onclick="window.history.back()">Voltar</button>



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

