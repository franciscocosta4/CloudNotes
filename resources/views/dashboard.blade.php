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
<!DOCTYPE html>
<html lang="en">
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
            <p>O seu nível aumenta à medida que partilha anotações com outras pessoas. <br>Para alcançar o próximo nível, continue a compartilhar as suas anotações!</p>
        </div>

        {{-- Verificação para garantir que $notes sempre seja definida --}}
<div class="published-notes-container">
    <h3>Anotações Publicadas Por Você</h3>
    {{-- Exibe as anotações publicadas --}}
    @isset($notes)
        @if($notes->isEmpty())
            <p>Você não publicou nenhuma anotação.</p>
        @else
            <ul>
                @foreach($notes as $note)
                    <li>
                        <a href="{{ url('/note/' . $note->slug) }}">{{ $note->title }}</a>
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
                <br>
                <ul>
                @if(isset($accessLogs))
    @foreach ($accessLogs as $log)
        <li><a href="{{ route('notes.show', $log->note->slug) }}">{{ $log->note->title }}</a></li>

    @endforeach
@else
    <p>Nenhum acesso recente encontrado.</p>
@endif
                    <br><br>
                    </ul>
                    <p>Ver anotações guardadas:</p>
                    <button onclick="location.href='/saved-notes'">Notas Guardadas</button>
                </nav>

                <!-- Profile Actions -->
                <div class="profile-actions">
                    <a class="action-btn" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 8px;">
                            <path d="M10 17l5-5-5-5v4h-4v2h4v4zm4-14h-9c-1.1 0-1.99.9-1.99 2l-.01 12c0 1.1.9 2 2 2h9c1.1 0 2-.9 2-2v-12c0-1.1-.9-2-2-2z"/>
                        </svg>
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="action-btn" onclick="location.href='https://github.com/franciscocosta4/CloudNotes'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 8px;">
                            <path d="M12 2c5.5 0 10 4.5 10 10s-4.5 10-10 10-10-4.5-10-10 4.5-10 10-10zm0 16c-1.7 0-3-1.3-3-3h6c0 1.7-1.3 3-3 3zm1-4h-2v-2h2v2zm1-6c0-.6-.4-1-1-1s-1 .4-1 1v2h-2v-2c0-.6-.4-1-1-1s-1 .4-1 1v5h2v-3h2v3h2v-5z"/>
                        </svg>
                        Ajuda
                    </button>
                </div>

                <!-- Profile Info -->
                <div class="profile-info">
                    <span id="username">{{ Auth::user()->name }}</span>
                    <button aria-label="profile" class="profile-btn" onclick="location.href='/profile'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zM12 14c-3.3 0-6 2.7-6 6v2h12v-2c0-3.3-2.7-6-6-6z"/>
                        </svg>
                    </button>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="main">
        <div class="main-content" id="search-container">
    <h2 id="search-title">Procurar por uma Anotação</h2>
    <!-- Formulário de pesquisa -->
        <form action="{{ route('search') }}" method="GET" id="search-form">
        <div class="search-container" id="input-search-container">
        <input 
            type="text" 
            name="query" 
            id="search-input" 
            placeholder="Entre palavras-chave para pesquisar..." 
            value="{{ old('query', $query ?? '') }}"
        >
        <button type="submit" aria-label="searchButton">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 9.5 5 13 7.01 13 9.5 10.99 14 9.5 14z"/>
            </svg>
        </button>
        </div>
        <div class="search-container" id="filters-search-container">
        <select aria-label="select-subject" name="disciplina" id="disciplina-select">
            <option value="">Todas as disciplinas</option>
            <option value="matematica" {{ request('disciplina') == 'matematica' ? 'selected' : '' }}>Matemática</option>
            <option value="fisica" {{ request('disciplina') == 'fisica' ? 'selected' : '' }}>Física</option>
            <option value="quimica" {{ request('disciplina') == 'quimica' ? 'selected' : '' }}>Química</option>
            <option value="geografia" {{ request('disciplina') == 'geografia' ? 'selected' : '' }}>Geografia</option>
            <option value="historia" {{ request('disciplina') == 'historia' ? 'selected' : '' }}>História</option>
            <option value="portugues" {{ request('disciplina') == 'portugues' ? 'selected' : '' }}>Português</option>
            <option value="ingles" {{ request('disciplina') == 'ingles' ? 'selected' : '' }}>Inglês</option>
            <option value="biologia" {{ request('disciplina') == 'biologia' ? 'selected' : '' }}>Biologia</option>
        </select>
        <select  aria-label="select-difficultity"name="dificuldade" id="dificuldade-select">
            <option value="">Todas as dificuldades</option>
            <option value="facil" {{ request('dificuldade') == 'facil' ? 'selected' : '' }}>Fácil</option>
            <option value="moderada" {{ request('dificuldade') == 'moderada' ? 'selected' : '' }}>Moderada</option>
            <option value="dificil" {{ request('dificuldade') == 'dificil' ? 'selected' : '' }}>Difícil</option>
        </select>
        </div>
    </form>

</div>
                <!-- Div de compartilhar -->
                <div id="share-container" class="main-content" style="display: {{ request('query') ? 'none' : 'block' }}">
                    <h2 id="search-title">Partilhar uma Anotação</h2>
                    <p style="margin-bottom:10px;">Clique para começar a partilhar</p>
                    <a  href="{{ route('notes.create')}}" id="share-button" style="margin:auto;background-color:#0F044C; color:white; border: none; padding: 8px 21px; cursor: pointer; border-radius: 8px; display: flex; align-items: center; justify-content: center; text-align: center; transition: background-color 0.3s, transform 0.3s;">
                        Partilhar
</a>
                </div>

                @if(isset($query) && !empty($query))
                    <h2>Resultados para: <strong>{{ $query }}</strong></h2>
                @endif

                <div id="search-results" style="display: {{ isset($query) && !empty($query) ? 'block' : 'none' }};">
                    @if(isset($results) && $results->isEmpty())
                        <p>Nenhum resultado encontrado.</p>
                    @elseif(isset($results))
                    <ul>
    @foreach ($results as $result)
        <div class="main-content">
            <button onclick="toggleNoteDetails('{{ $result->id }}')">
                <li>
                <a id="link-note" href="{{ url('note/' . $result->slug) }}">
                    <div id="note-summary-{{ $result->id }}" class="note-summary" style="width: 600px;">
                        <!-- Link correto para o slug -->
                        <h2>{{ $result->title }}</h2>
                        <p><strong>Disciplina:</strong> {{ $result->subject }}</p>
                        <p><strong>Utilizador:</strong> {{ $result->user->name }}</p>
                        <p><strong>Dificuldade:</strong> {{ $result->topic_difficulty }}</p>
                    </div>
                    </a>


                </li>
            </button>
        </div>
    @endforeach
</ul>

                    @endif
                </div>

                <!-- Botão para voltar -->
                <button id="back-button" class="btn btn-secondary" style="display: {{ request('query') ? 'inline-block' : 'none' }};" onclick="window.location.href='{{ url('/dashboard') }}'">Voltar</button>
            </main>
        </div>
    </x-app-layout>
</body>
</html>
<script>
   document.getElementById('search-form').addEventListener('submit', function (e) {
    e.preventDefault(); // Impede o comportamento padrão do formulário (envio e recarregamento da página)
    
    const disciplinaSelect = document.getElementById('disciplina-select');
    const dificuldadeSelect = document.getElementById('dificuldade-select');
    const searchInput = document.getElementById('search-input');

    // Se o valor da disciplina estiver vazio, remove o parâmetro da URL
    if (disciplinaSelect.value === "") {
        disciplinaSelect.removeAttribute('name');
    }

    if (dificuldadeSelect.value === "") {
        dificuldadeSelect.removeAttribute('name');
    }

    // Verifica se o campo de busca está vazio e exibe o alerta
    if (searchInput.value === "") {
        alert("Insira alguma palavra antes de pesquisar");
        return; // Para a execução aqui e não envia o formulário
    }

    // Se chegou aqui, o formulário será enviado manualmente
    this.submit(); // Envia o formulário caso os campos estejam válidos
});

</script> 