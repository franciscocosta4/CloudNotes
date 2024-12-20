<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<x-app-layout>
    <div class="user-level-container">
        <!-- Exibe o nível atual do utilizador -->
        <div class="user-level">
            <h1>{{ __('Você está nível ') . Auth::user()->level }} 21</h1>
        </div>

        <!-- Título explicando como aumentar o nível -->
        <h3>Como aumentar o nível?</h3>

        <!-- Explicação sobre como aumentar o nível -->
        <p>O seu nível aumenta à medida que partilha anotações com outras pessoas. <br>Para alcançar o próximo nível, continue a compartilhar as suas anotações!</p>
    </div>
 <!-- Container de anotações publicadas -->
 <div class="published-notes-container">
        <h3>Anotações Publicadas Por Você</h3>
        <ul>
            <li><a href="#">Anotação 1</a></li>
            <li><a href="#">Anotação 2</a></li>
            <li><a href="#">Anotação 3</a></li>
            <li><a href="#">Anotação 4</a></li>
            <li><a href="#">Anotação 5</a></li>
        </ul>
    </div>


    <!-- Incluindo o CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h2 class="CloudNotestitle">CloudNotes</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <p>Recentes:</p>
                    <br>
                    <li><a href="#">Nota 1</a></li>
                    <li><a href="#">Nota 2</a></li>
                    <li><a href="#">Nota 3</a></li>
                    <li><a href="#">Nota 4</a></li>
                    <li><a href="#">Nota 5</a></li>
                    
                </ul>
                <br><br>
                <p>Ver anotações guardadas:</p>
                <button onclick="location.href='/saved-notes'">Notas Guardadas</button>
            </nav>


<!-- Adicionando os botões "Sair" e "Ajuda" com ícones -->
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
    <button class="action-btn" onclick="location.href='/help'">
        <!-- Ícone de Ajuda -->
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 8px;">
            <path d="M12 2c5.5 0 10 4.5 10 10s-4.5 10-10 10-10-4.5-10-10 4.5-10 10-10zm0 16c-1.7 0-3-1.3-3-3h6c0 1.7-1.3 3-3 3zm1-4h-2v-2h2v2zm1-6c0-.6-.4-1-1-1s-1 .4-1 1v2h-2v-2c0-.6-.4-1-1-1s-1 .4-1 1v5h2v-3h2v3h2v-5z"/>
        </svg>
        Ajuda
    </button>
</div>
          
<div class="profile-info">
    <span id="username">
        {{ Auth::user()->name }}
    </span>
    <button class="profile-btn" onclick="location.href='/profile'">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zM12 14c-3.3 0-6 2.7-6 6v2h12v-2c0-3.3-2.7-6-6-6z"/>
        </svg>
    </button>
</div>

        </aside>

        <!-- Main Content -->
        <main class="main">
            <div class="main-content">
                <h2>Procurar por uma Anotação</h2>
                <div class="search-container">
                    <input type="text" placeholder="Entre palavras-chave para pesquisar...">
                    <button onclick="executeSearch()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C8.01 14 6 11.99 6 9.5S8.01 5 9.5 5 13 7.01 13 9.5 10.99 14 9.5 14z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="main-content">
                <h2>Partilhar uma Nova Anotação</h2>
                <p>Clique para começar</p>
                <button class="sharenotesbutton">Partilhar Agora</button>
            </div>
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-btn');

        // Função para alternar a visibilidade da sidebar
        function toggleSidebar() {
            sidebar.classList.toggle('hidden');
        }

        // Função para executar a pesquisa
        function executeSearch() {
            const query = document.querySelector('.search-container input').value;
            if (query.trim()) {
                alert(`Pesquisando por: ${query}`);
                // Adicione aqui a lógica de pesquisa
            } else {
                alert('Por favor, insira palavras-chave para pesquisar.');
            }
        }
    </script>
</x-app-layout>