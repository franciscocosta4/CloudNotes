
<!-- Preload do estilo local -->
<link rel="preload" href="{{ asset('css/style.css') }}" as="style" onload="this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</noscript>

<!-- Preload do Google Fonts -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" as="style" onload="this.rel='stylesheet'">
<noscript>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</noscript>

<div class="container">
    <h1>Dashboard</h1>

    <!-- Exibindo utilizadores -->
    <h2>Utilizadores</h2>
    <!-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Criar Novo Usuário</a> -->
    <table class="table"  border="true">
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
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
     <!-- Exibindo ANOTAÇÕES -->
     <h2>Anotações</h2>
    <!-- <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Criar Nova anotação</a> -->

    <table class="table" border="true">
        <thead>
            <tr>
                <th>user_id</th>
                <th>title</th>
                <th>subject</th>
                <th>topic_difficulty</th>
                <th>content</th>
                <th>file_path</th>
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
                    <td>{{ $note->content }}</td> 
                    <td>{{ $note->file_path }}</td> 
                    
                    <td>
                        <a href="{{ route('admin.notes.edit', $note->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('admin.notes.destroy', $note->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
