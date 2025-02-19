@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header ">
            <h4 class=" mb-0 card-title ">Editar Nota</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.notes.update', $note->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" name="title" id="title" class="form-control"
                        value="{{ old('title', $note->title) }}" required>
                </div>
                <div class="form-group">
                    <label for="subject">Matéria</label>
                    <input type="text" name="subject" id="subject" class="form-control"
                        value="{{ old('subject', $note->subject) }}" required>
                </div>
                <div class="form-group">
                    <label for="topic_difficulty">Dificuldade do Tópico</label>
                    <select name="topic_difficulty" id="topic_difficulty" class="form-control" required>
                        <option value="Fácil"
                            {{ old('topic_difficulty', $note->topic_difficulty) == 'Fácil' ? 'selected' : '' }}>Fácil
                        </option>
                        <option value="Médio"
                            {{ old('topic_difficulty', $note->topic_difficulty) == 'Médio' ? 'selected' : '' }}>Médio
                        </option>
                        <option value="Difícil"
                            {{ old('topic_difficulty', $note->topic_difficulty) == 'Difícil' ? 'selected' : '' }}>
                            Difícil</option>
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
                        <p>Arquivo atual: <a href="{{ asset('storage/' . $note->file_path) }}"
                                target="_blank">Visualizar</a></p>
                    @endif
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Guardar Alterações</button>
                <button type="submit" class="btn btn-black" onclick="window.history.back()">Voltar</button>
            </form>
        </div>
    </div>
</div>
@endsection