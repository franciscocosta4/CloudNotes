@extends('layouts.admin')

@section('content')
<body>
    <div class="container mt-5">
    <h3 class="mb-3">Dashboard de Administração</h3>
        <div class="card mb-4">
            <div class="card-header " >
                <h4 class=" mb-0 card-title ">Criar Utilizador</h4>
            </div>
            <div class="card-body mb-4">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
 
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Senha </label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <!-- Ano Escolar -->
                    <div class="form-group">
                        <x-input-label for="school_year" :value="__('Ano Escolar')" /><br>
                            <select id="school_year" name="school_year" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required >
                                <option value="" disabled selected>{{ __('Selecione o Ano Escolar') }}</option>
                                    @for ($i = 7; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ old('school_year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                            </select>
                        <x-input-error :messages="$errors->get('school_year')" class="mt-2" />
                    </div>
                     <!--Disciplinas de interesse -->
                     <div class="form-group">
                        <x-input-label for="subjects_of_interest" :value="__('Disciplinas de Interesse')" /><br>
                        <!-- <label for="subjects_of_interest">Disciplinas de Interesse</label> -->
                            <select id="subjects_of_interest"name="subjects_of_interest[]" id="subjects_of_interest" class="block mt-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" multiple >
                                @foreach($allSubjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        <x-input-error :messages="$errors->get('subjects_of_interest')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <label for="role">Definir as permissões:</label>
                        <br>
                            <input type="radio" name="role" id="roleAdmin"value="admin" >
                            <label for="roleAdmin">Admin</label>
                            <input type="radio" name="role" id="roleUser" value="user" >
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