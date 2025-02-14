@extends('layouts.admin')

@section('content')

<div class="container">
    <br>
    <h1 class="mb-3">Dashboard de Administração</h1>

    <!-- Exibindo Utilizadores -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Utilizadores</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm">Editar</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Exibindo Anotações -->
    <div class="card mb-4">
        <div class="card-header">
            <h2>Anotações</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Título</th>
                        <th>Assunto</th>
                        <th>Dificuldade</th>
                        <th>Conteúdo</th>
                        <th>Ficheiro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                        <tr>
                            <td>{{ $note->user_id }}</td>
                            <td>{{ $note->title }}</td>
                            <td>{{ $note->subject }}</td>
                            <td>{{ $note->topic_difficulty }}</td>
                            <td>{{ Str::limit($note->content, 50) }}</td>
                            <td>{{ $note->file_path }}</td>
                            <td >
                                <a href="{{ route('admin.notes.edit', $note->id) }}" style="width: 94px;" class="btn btn-secondary btn-sm">
                                <i class="fa fa-plus">
                                </i>
                                Editar
                            </a>
                                <br>
                                <br>
                                <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" style="width: 94px;" >Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Exibindo Logs de Acesso -->
    <div class="card">
        <div class="card-header">
            <h2>Logs de Acesso</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Note ID</th>
                        <th>Data de Criação</th>
                        <th>Última Atualização</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="logs">
                    @foreach($logs as $log)
                        <tr>
                            <td>{{ $log->user_id }}</td>
                            <td>{{ $log->note_id }}</td>
                            <td>{{ $log->created_at }}</td>
                            <td>{{ $log->updated_at }}</td>
                            <td>
                                <form action="{{ route('admin.logs.destroy', $log->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>  
@endsection
