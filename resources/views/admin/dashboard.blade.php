@extends('layouts.admin')

@section('content')
<br>
<div class="container">
<h3 class="mb-3">Dashboard de Administração</h3>
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
                            <div class="icon-big text-center icon-success   bubble-shadow-small">
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
    </div>
</div>
<div class="container">
    <div class="row">
        <!-- Coluna para a Tabela de Utilizadores -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 id="usersList" class="card-title">Utilizadores</h4>
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
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-info btn-sm"> Editar </a>
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
                                    <a href="{{ Storage::url($ficheiro->file_path) }}" 
                                       download="{{ $ficheiro->title }}.{{ pathinfo($ficheiro->file_path, PATHINFO_EXTENSION) }}" class="text-muted"> 
                                       {{ $ficheiro->title }}.{{ pathinfo($ficheiro->file_path, PATHINFO_EXTENSION) }}
                                    </a>
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


    <!-- Exibindo Anotações -->
    <div class="card mb-4">
        <div class="card-header">
            <h4 class="card-title">Anotações</h4>
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
                                <a href="{{ route('admin.notes.edit', $note->id) }}" >
                                <button class="btn ">
                                <i class="fa fa-edit fa-lg">
                                </i>
                                </button>
                            </a>
            
                                <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST" >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" > <i class="fas fa-trash-alt fa-lg"">
                                    </i> </button>
                                </form>
                                </div>
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
            <h4 class="card-title">Logs de Acesso a publicações</h4>
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

@endsection
<style>
    /* PARA QUE O FILE PATH DÊ ENTER E NAO FIQUE MUITO COMPRIDO */
    .break-word {
        word-wrap: break-word;
        max-width: 200px; 
        white-space: normal;
    }
</style>
