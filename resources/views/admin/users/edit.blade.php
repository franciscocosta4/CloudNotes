@extends('layouts.admin')

@section('content')
<body>
    
    <div class="container mt-5">
    <h3 class="mb-3">Dashboard de Administração</h3>
        <div class="card mb-4">
            <div class="card-header " >
                <h4 class=" mb-0 card-title ">Editar Utilizador</h4>
            </div>
            <div class="card-body mb-4">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="school_year">Ano Escolar</label>
                        <input type="text" name="school_year" id="school_year" class="form-control"
                            value="{{ old('school_year', $user->school_year) }}">
                    </div>

                    <div class="form-group">
                        <label for="subjects_of_interest">Disciplinas de Interesse</label>
                        <input type="text" name="subjects_of_interest" id="subjects_of_interest" class="form-control"
                            value="{{ old('subjects_of_interest', $user->subjects_of_interest) }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Senha (Deixe vazio para manter a senha atual)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Senha</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="form-control">
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar Alterações</button>
                    <button type="submit" class="btn btn-black" onclick="window.history.back()">Voltar</button>
                </form>
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