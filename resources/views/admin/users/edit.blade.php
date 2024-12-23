
<div class="container">
    <h1>Editar Usuário</h1>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label for="school_year">Ano Escolar</label>
            <input type="text" name="school_year" id="school_year" class="form-control" value="{{ old('school_year', $user->school_year) }}">
        </div>

        <div class="form-group">
            <label for="subjects_of_interest">Disciplinas de Interesse</label>
            <input type="text" name="subjects_of_interest" id="subjects_of_interest" class="form-control" value="{{ old('subjects_of_interest', $user->subjects_of_interest) }}">
        </div>

        <div class="form-group">
            <label for="password">Senha (Deixe vazio para manter a senha atual)</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Senha</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
