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
                    <label>Disciplinas de Interesse</label>
                        @php
                            $subjects = ['Matemática', 'Física', 'Química', 'Biologia', 'Português', 'História', 'Geografia', 'Inglês'];
                            $selectedSubjects = json_decode($user->subjects_of_interest, true) ?? [];
                    @endphp
                    <div class="row">
                    <div class="col-md-6">
                        @foreach (array_slice($subjects, 0, 4) as $subject)
                            <div class="form-check">
                                <input type="checkbox" name="subjects_of_interest[]" value="{{ $subject }}" 
                                    {{ in_array($subject, $selectedSubjects) ? 'checked' : '' }} class="form-check-input">
                                <label class="form-check-label">{{ $subject }}</label>
                             </div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        @foreach (array_slice($subjects, 4) as $subject)
                            <div class="form-check">
                                <input type="checkbox" name="subjects_of_interest[]" value="{{ $subject }}" 
                                    {{ in_array($subject, $selectedSubjects) ? 'checked' : '' }} class="form-check-input">
                                <label class="form-check-label">{{ $subject }}</label>
                            </div>
                        @endforeach
                     </div>
                    </div>
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
                    <div class="form-group">
                        <label for="role">Mudar as permissões:</label>
                        <br>
                            <input type="radio" name="role" id="roleAdmin" value="admin" 
                            {{ old('role', $user->role) === 'admin' ? 'checked' : '' }}>
                            <label for="roleAdmin">Admin</label>
                            <input type="radio" name="role" id="roleUser" value="user" 
                             {{ old('role', $user->role) === 'user' ? 'checked' : '' }}>
                            <label for="roleUser">User</label>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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