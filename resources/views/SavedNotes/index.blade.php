<!-- Preload do estilo local -->
<link rel="preload" href="{{ asset('css/style.css') }}" as="style" onload="this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</noscript>
<!-- Preload do Google Google icons -->
<link rel="preload" href="https://fonts.googleapis.com/icon?family=Material+Icons" as="style"
    onload="this.rel='stylesheet'">
<noscript>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</noscript>
<!-- Preload do Google Fonts -->
<link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" as="style"
    onload="this.rel='stylesheet'">
<noscript>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</noscript>

<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CloudNotes</title>
</head>

<body>
    <x-app-layout>
        <div class="user-level-container">
            <div class="user-level">
                @php
                    $points = Auth::user()->points;
                    $level = floor($points / 1000); //* Calcula o nível
                    $pointsForNextLevel = 1000 - ($points % 1000); //* Calcula os pontos restantes para o próximo nível
                @endphp
                <h1>{{ __('Você está no nível ') . $level }}</h1>
                <p>{{ __('Faltam ') . $pointsForNextLevel . __(' pontos para o próximo nível.') }}</p>
            </div>
            <h3>Como aumentar o nível?</h3>
            <p>O seu nível aumenta à medida que partilha anotações com outras pessoas. <br>Para alcançar o próximo
                nível, continue a compartilhar as suas anotações!</p>
        </div>
        <div class="published-notes-container">
            <h3>Anotações Publicadas Por Você</h3>
            @isset($notes)
                @if($notes->isEmpty())
                    <p>Você não publicou nenhuma anotação.</p>
                @else
                    <ul>
                        @foreach($notes as $note)
                            <li style="display: flex; align-items: center; justify-content: space-between;">
                                <a href="{{ url('/note/' . $note->slug) }}">{{ $note->title }}</a>
                                <form action="{{ route('notes.destroy', $note->id)}}" method="POST"
                                    onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" id="DeleteNotesButton" class="material-icons">delete</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @endif
            @else
                <p>Não foi possível carregar as suas anotações.</p>
            @endisset
        </div>
        <div class="container">
            <!-- Sidebar -->
            <aside class="sidebar" id="sidebar">
                <div class="sidebar-header">
                    <h2 class="CloudNotestitle"><a href="/dashboard">CloudNotes</a></h2>
                </div>
                <nav class="sidebar-nav">
                    <p>Recentes:</p>
                    <ul>
                        @if(isset($accessLogs) && $accessLogs->isNotEmpty())
                            <ul>
                                @foreach ($accessLogs as $log)
                                    @if($log->note)
                                        <li><a href="{{ route('notes.show', $log->note->slug) }}">{{ $log->note->title }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>Nenhuma publicação acessada.</li>
                            </ul>
                        @endif
                        <br><br>
                    </ul>
                </nav>
                <div class="saved-notes">
                    <p>Voltar para a dashboard:</p>
                    <button onclick="location.href='{{ route('dashboard') }}'"
                        style="font-family: 'Poppins', sans-serif;">Dashboard</button>
                </div>
                <!-- Profile Actions -->
                <div class="profile-actions">
                    <a class="action-btn" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="material-icons" style="margin-right: 5px;">logout</span>
                        <span> Sair</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="action-btn" onclick="location.href='https://github.com/franciscocosta4/CloudNotes'">
                        <span class="material-icons" style="margin-right: 5px;">info</span>
                        <span> Ajuda</span>
                    </button>
                </div>

                <!-- Profile Info -->
                <button aria-label="profile" class="profile-info" onclick="location.href='/profile'">
                    <span id="username">{{ Auth::user()->name }}</span>
                    <span class="material-icons">person</span>
        </div>
        </aside>

        <!-- Main Content -->
        <main class="main">
            <div class="saved-notes-container">
                <h2>Anotações Guardadas</h2>

                @if($SavedNotes->isEmpty())
                    <p class="empty-message">Não tens notas guardadas.</p>
                @else
                    <ul class="saved-notes-list">
                        @foreach($SavedNotes as $note)
                            <li class="saved-note-item">
                                <div class="saved-note-content">
                                    <div class="saved-note-title">
                                        <a href="{{ url('/note/' . $note->slug) }}">{{ $note->title }}</a>
                                    </div>
                                    <div class="saved-note-meta">
                                        <span class="note-author">Autor: {{ $note->user->name }}</span>
                                        <span class="note-likes">Gostos: {{ $note->likes->count() }}</span>
                                    </div>
                                </div>
                                <form action="{{ route('notes.saved.remove', $note->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    <button type="submit" class="remove-btn">
                                        <span class="material-icons">delete</span>
                                        Remover
                                    </button>
                                </form>
                            </li>
                            <br>
                        @endforeach
                    </ul>
                    <div class="saved-notes">
                        <p>Voltar para a dashboard:</p>
                        <button onclick="location.href='{{ route('dashboard') }}'"
                            style="font-family: 'Poppins', sans-serif;">Dashboard</button>
                    </div>
                @endif
            </div>
        </main>
        </div>
    </x-app-layout>
</body>

</html>
<script>
    // Adicionando confirmação antes de remover
    document.querySelectorAll('.remove-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            if (!confirm('Tem certeza que deseja remover esta nota das suas notas guardadas?')) {
                e.preventDefault();
            }
        });
    });
</script>

<style>
    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body,
    html {
        height: 100%;
        font-family: 'Poppins', sans-serif;
        background-color: #F8F9FA;
        color: #444;
        font-size: 14px;
    }

    .saved-notes-container {
        width: 700px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        font-family: 'Poppins', sans-serif;
    }

    .saved-notes-container h2 {
        font-size: 1.4rem;
        margin-bottom: 1.2rem;
        font-weight: 600;
        color: #0F044C;
    }

    .saved-notes-list {
        list-style: none;
        padding: 0;
    }

    .saved-note-item {
        border: 2px solid rgb(200, 200, 200);
        border-radius: 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        transition: background-color 0.3s;
    }

    .saved-note-item:hover {
        background-color: #f9f9f9;
    }

    .saved-note-content {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .saved-note-title {
        color: #333;
    }

    .saved-note-title a {
        color: #0F044C;
        text-decoration: none;
        transition: color 0.3s;
        font-weight: 500;
    }

    .saved-note-title a:hover {
        color: #3a2b8d;
        text-decoration: underline;
    }

    .saved-note-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.85rem;
        color: #666;
    }

    .note-author,
    .note-likes {
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .remove-btn {
        margin-left: 14px;
        border: 2px solid #DDD;
        color: gray;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-size: 0.9rem;
        transition: background-color 0.3s, transform 0.2s;
        display: flex;
        align-items: center;
        gap: 5px;
        background-color: #fff;
    }

    .remove-btn:hover {
        background-color: #c0392b;
        color: white;
        transform: translateY(-2px);
    }

    .empty-message {
        text-align: center;
        color: #666;
        font-size: 1.1rem;
        padding: 2rem;
        background-color: #f8f9fa;
        border-radius: 8px;
    }

    @media (max-width: 768px) {
        .saved-notes-container {
            padding: 1rem;
            margin: 1rem;
        }

        .saved-note-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }

        .remove-btn {
            margin-left: 0;
            margin-top: 0.5rem;
            align-self: flex-end;
        }
    }
</style>