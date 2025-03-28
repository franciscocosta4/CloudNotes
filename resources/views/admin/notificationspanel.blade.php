@extends('layouts.admin')

@section('content')
<div class="container">
    <br>
    <h2 class="fw-bold mb-3">Painel de Notificações</h2>
    <div class="row">
        <div class="col-md-12">
            <ul class="timeline">
                @foreach($adminActions as $adminAction)
                    <li class="{{ preg_match('/\b(excluída|excluído)\b/i', $adminAction->message) ? 'timeline-inverted' : '' }}">
                        <div class="timeline-badge 
                            {{ preg_match('/\b(excluída|excluído)\b/i', $adminAction->message) ? 'danger' :
                            (preg_match('/\b(criada|criado)\b/i', $adminAction->message) ? 'success' : 'info') }}">
                            <i class="fas 
                                {{ preg_match('/\b(excluída|excluído)\b/i', $adminAction->message) ? 'fa-trash-alt' :
                                (preg_match('/\b(criada|criado)\b/i', $adminAction->message) ? 'fa-user-plus' : 'fa-hdd') }}">
                            </i>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">
                                    {{ $adminAction->admin_id ? \App\Models\User::find($adminAction->admin_id)->name : 'Desconhecido' }}
                                    <small class="text-muted">
                                    <i class=" fas fa-clock"></i> {{ $adminAction->created_at->format('d/m/Y H:i') }}
                                </small>
                                </h4>
                            </div>
                            <div class="timeline-body">
                                <p>{{ $adminAction->message }}</p>
                                <br>
                                <div class="btn-group dropdown">
                                    <button class="btn btn-info btn-border btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                        <span class="btn-label">
                                            <i class="fa fa-cog"></i>
                                        </span>
                                    </button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="">apagar notificação</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection

<style>
    html{
        overflow-x: hidden;
    }
    .timeline-title small {
    margin-left: 58%;  /* Ajuste o valor conforme necessário */
    }
    h2{
        margin-left: 40%;
    }


   
</style>