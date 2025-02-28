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

                    <!-- Ano Escolar -->
                    <div class="form-group">
                        <x-input-label for="school_year" :value="__('Ano Escolar')" /><br>
                            <select id="school_year" name="school_year" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" >
                                <option value="" disabled selected>{{ old('school_year', $user->school_year) }}</option>
                                    @for ($i = 7; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('school_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                            </select>
                        <x-input-error :messages="$errors->get('school_year')" class="mt-2" />
                    </div>

                    <div class="form-group">
                    <label>Disciplinas de Interesse</label>
                    @php
                        // Obter todas as disciplinas da base de dados
                        $subjects = App\Models\Subject::all();
                        // Obter as disciplinas associadas ao utilizador (IDs)
                        $selectedSubjects = $user->subjects->pluck('id')->toArray(); // Pega os IDs das disciplinas associadas ao utilizador
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            @foreach ($subjects->take(4) as $subject) <!-- Apenas os 4 primeiros -->
                                <div class="form-check">
                                    <input type="checkbox" name="subjects_of_interest[]" value="{{ $subject->id }}" 
                                        {{ in_array($subject->id, $selectedSubjects) ? 'checked' : '' }} class="form-check-input">
                                    <label class="form-check-label">{{ $subject->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    <div class="col-md-6">
                        @foreach ($subjects->skip(4) as $subject) <!-- A partir do 5º item -->
                            <div class="form-check">
                                <input type="checkbox" name="subjects_of_interest[]" value="{{ $subject->id }}" 
                                    {{ in_array($subject->id, $selectedSubjects) ? 'checked' : '' }} class="form-check-input">
                                <label class="form-check-label">{{ $subject->name }}</label>
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