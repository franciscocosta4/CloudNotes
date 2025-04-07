@php($hideFooter = true)
@extends('layouts.admin')

@section('content')
    <div class="mx-3 mt-3">
        @if(isset($query) && !empty($query))
            <p>Resultados para: <strong>{{ $query }}</strong></p>
        @endif
    </div>
    <div class="container mt-4 mx-2">
        <h4>Utilizadores encontrados: </h4>
        @if($results['users']->isNotEmpty())
            @foreach ($results['users'] as $user)
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span style="width:60px; height: 60px;" class="stamp stamp-md bg-none me-3">
                                    <i style=" font-size: 18px; margin-top:45%;" class="fas fa-user-alt"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1">
                                        <b><a href="{{route("admin.users.edit", $user->id) }}">{{ $user->name }}</a></b>
                                    </h5>
                                    <small class="text-muted">
                                        role: {{ $user->role }}
                                        <span style="margin-right: 5px;"></span>
                                        email: {{ $user->email }}
                                        <span style="margin-right: 5px;"></span>
                                        ano escolar: {{ $user->school_year }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>sem resultados</p>
        @endif
        <h4>Publicações encontradas: </h4>
        @if($results['notes']->isNotEmpty())
                @foreach ($results['notes'] as $note)
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span  style="width:60px; height: 60px;"class="stamp stamp-md bg-black me-3">
                                    <i style=" font-size: 18px; margin-top:45%;" class="  fas fa-sticky-note"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1">
                                        <b><a href="{{route("admin.notes.edit", $note->id) }}">{{ $note->title }}</a></b>
                                    </h5>
                                    <small class="text-muted">
                                        disciplina: {{ $note->subject }}
                                        <span style="margin-right: 5px;"></span>
                                        dificuldade: {{ $note->topic_difficulty }}
                                        <span style="margin-right: 5px;"></span>
                                        utilizador: {{ $note->user?->name ?? 'Utilizador não encontrado' }}</p>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
        @else
            <p>sem resultados</p>
        @endif
    </div>


@endsection

<style>
    html {
        overflow-x: hidden;
    }
</style>