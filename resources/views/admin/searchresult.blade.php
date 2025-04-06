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
            <div class="row">
                @foreach ($results['users'] as $user)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-info me-3">
                                    <i style="margin-top:40%;" class="fas fa-user-alt"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1">
                                    <b><a href="{{route("admin.users.edit", $user->id) }}">{{ $user->name }}</a></b>
                                    </h5>
                                    <small class="text-muted">role: {{ $user->role }} <br>
                                        pontos: {{ $user->points }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>sem resultados</p>
        @endif
        <h4>Publicações encontradas: </h4>
        @if($results['notes']->isNotEmpty())
            <div class="row">
                @foreach ($results['notes'] as $note)
                    <div class="col-sm-6 col-lg-3">
                        <div class="card p-3">
                            <div class="d-flex align-items-center">
                                <span class="stamp stamp-md bg-black me-3">
                                    <i style="margin-top:40%;"class="  fas fa-sticky-note"></i>
                                </span>
                                <div>
                                    <h5 class="mb-1">
                                        <b><a href="{{route("admin.notes.edit", $note->id) }}">{{ $note->title }}</a></b>
                                    </h5>
                                    <small class="text-muted">
                                        disciplina: {{ $note->subject }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
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