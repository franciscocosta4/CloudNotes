@extends('layouts.admin')

@section('content')

<style>
    html, body {
    overflow-x: hidden;
}
</style>
<br>
<div class="container ">
    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 "> 
    <h3 class="mb-3">Dashboard de Administração</h3>
        <div class="ms-md-auto py-2 py-md-0">
            <a href="{{ route('dashboard') }}" class="btn btn-primary btn-border btn-round mt-2">Ir Para a Aplicação</a>
            <!-- <a href="{{ route('admin.subjects.create') }}" class="btn btn-info  btn-round mt-2">Adicionar Disciplina</a> -->
            <a href="{{ route('admin.users.create') }}" class="btn btn-info btn-round mt-2"> Criar Utilizador </a>
        </div>
    </div>
    <p class="card-category">Dados sobre a aplicação:</p><br>
    <div class="row">
        <div class="col-sm-6 col-md-3" style="width:300px;">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-user-check"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Utilizadores registrados</p>
                                <h4 class="class-title"> {{ $totalUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3" style="width:300px;">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary  bubble-shadow-small">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Visitas</p>
                                <h4 class="class-title"> muitas mesmo </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-sm-6 col-md-3" style="width:300px;">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary   bubble-shadow-small">
                                <i class="fab fa-telegram-plane"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Total de publicações</p>
                                <h4 class="class-title"> {{ $PublishedNotes }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3" style="width:300px;">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success   bubble-shadow-small">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Disciplinas suportadas</p>
                                <h4 class="class-title"> {{ $totalSubjects }} </h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</div>

<!-- Tabela de Utilizadores e Card de Ficheiros Partilhados -->
<div class="container">
    <div class="row">
        <!-- Coluna para a Tabela de Utilizadores -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 id="usersList" class="card-title">Utilizadores 
                    </h4>
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
                                    <div class="column d-flex gap-2">
                                            <form action="{{ route('admin.users.edit', $user->id) }}" method="GET" style="display:inline;">
                                                <button type="submit" class="btn btn-info btn-sm">Editar</button>
                                            </form>
                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Coluna para o Card de Ficheiros Partilhados -->
        <div class="col-md-4">
            <div class="card card-secondary bg-secondary-gradient">
                <div class="card-header">
                    <h4>Ficheiros Partilhados</h4>
                    <p>Aqui estão os últimos ficheiros partilhados pelos utilizadores: </p>
                </div>
                <div class="card-body curves-shadow">
                    @if($ficheiros->isEmpty())
                        <p>Nenhum ficheiro partilhado.</p>
                    @else
                        <ul class="list-group">
                            @foreach($ficheiros as $ficheiro)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="column">
                                    <p style="font-size: 0.875rem; margin-bottom: 0.2rem;">{{ $ficheiro->user->name ?? 'Sem utilizador' }}</p>
                                    <a href="{{ Storage::url($ficheiro->file_path) }}" 
                                    download="{{ $ficheiro->title }}.{{ pathinfo($ficheiro->file_path, PATHINFO_EXTENSION) }}" class="text-muted"> 
                                    {{ $ficheiro->title }}.{{ pathinfo($ficheiro->file_path, PATHINFO_EXTENSION) }}
                                    </a>
                                </div>
                            <span class="badge badge-success">{{ $ficheiro->created_at->diffForHumans() }}</span>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TABELA DE DISCIPLINAS -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title" id="subjects">Disciplinas disponíveis</h4>
                        <a href="{{ route('admin.subjects.create') }}" class="btn btn-info  btn-round ms-auto">
                            <i class="fa fa-plus"></i>
                            Adicionar Disciplina
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Data de Criação</th>
                                <th>Última Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->id }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->created_at }}</td>
                                    <td>{{ $subject->updated_at }}</td>
                                    <td>
                                        <form action="{{ route('admin.subjects.destroy', $subject->id) }}" method="POST" style="display:inline;">
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
    </div>
</div>


<!-- Tabela de Anotações -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title" id="anotacoes">Anotações Publicadas</h4>
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
                                    <td class="break-word">{{ $note->file_path }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="{{ route('admin.notes.edit', $note->id) }}">
                                                <button class="btn">
                                                    <i class="fa fa-edit fa-lg"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn">
                                                    <i class="fas fa-trash-alt fa-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Tabela de Logs -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title" id="logs">Logs de Acesso a publicações</h4>
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
                        <tbody>
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
    </div>
</div>


<!-- Tabela de Logs de pontos -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title" id="points">Pontos</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>points</th>
                                <th>tipo</th>
                                <th>Data de Criação</th>
                                <th>Última Atualização</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach($points as $point)
                                <tr>
                                    <td>{{ $point->user_id }}</td>
                                    <td>{{ $point->points }}</td>
                                    <td>{{ $point->type }}</td>
                                    <td>{{ $point->created_at }}</td>
                                    <td>{{ $point->updated_at }}</td>
                                    <td>
                                        <form action="{{ route('admin.points.destroy', $point->id) }}" method="POST" style="display:inline;">
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
    </div>
</div>

@endsection

<style>
    /* PARA QUE O FILE PATH DÊ ENTER E NAO FIQUE MUITO COMPRIDO */
    .break-word {
        word-wrap: break-word;
        max-width: 200px; 
        white-space: normal;
    }

    /* Remover margens extras e garantir que o contêiner ocupe 100% da largura */
    .container {
        width: 100%;
        max-width: 100%;
        padding-left: 15px;
        padding-right: 15px;
        margin: 0 auto;
    }

    /* Ajustar o espaçamento vertical entre as tabelas */
    .card {
        margin-bottom: 20px; /* Espaçamento consistente entre as tabelas */
    }
</style>