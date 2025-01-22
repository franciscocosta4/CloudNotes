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
            <input type="text" name="subject" id="subject" class="form-control" required>
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
<button id="back-button" class="btn btn-secondary"  onclick="window.history.back()">Voltar</button>