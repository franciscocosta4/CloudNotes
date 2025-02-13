
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
    <h1>Editar Nota</h1>
    <form action="{{ route('admin.notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $note->title) }}" required>
        </div>
        <div class="form-group">
            <label for="subject">Matéria</label>
            <input type="text" name="subject" id="subject" class="form-control" value="{{ old('subject', $note->subject) }}" required>
        </div>
        <div class="form-group">
            <label for="topic_difficulty">Dificuldade do Tópico</label>
            <select name="topic_difficulty" id="topic_difficulty" class="form-control" required>
                <option value="Fácil" {{ old('topic_difficulty', $note->topic_difficulty) == 'Fácil' ? 'selected' : '' }}>Fácil</option>
                <option value="Médio" {{ old('topic_difficulty', $note->topic_difficulty) == 'Médio' ? 'selected' : '' }}>Médio</option>
                <option value="Difícil" {{ old('topic_difficulty', $note->topic_difficulty) == 'Difícil' ? 'selected' : '' }}>Difícil</option>
            </select>
        </div>
        <div class="form-group">
            <label for="content">Conteúdo</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $note->content) }}</textarea>
        </div>
        <div class="form-group">
            <label for="file_path">Arquivo (opcional)</label>
            <input type="file" name="file_path" id="file_path" class="form-control">
                @if ($note->file_path)
                    <p>Arquivo atual: <a href="{{ asset('storage/' . $note->file_path) }}" target="_blank">Visualizar</a></p>
                @endif
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>

