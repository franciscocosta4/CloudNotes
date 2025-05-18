<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - CloudNotes</title>
    <!-- Preload do Google Fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" as="style"
        onload="this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    </noscript>
    <style>
        :root {
            --primary-color: #0F044C;
            --secondary-color: #F8F9FA;
            --text-color: #444;
            --border-color: #ddd;
            --error-color: #dc3545;
            --hover-effect: scale(1.02);
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        body,
        html {
            font-family: 'Poppins', sans-serif;
            background-color: var(--secondary-color);
            color: var(--text-color);
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }

        .profile-container {
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .profile-title {
            font-size: 2rem;
            color: var(--primary-color);
            font-weight: 500;
            margin: 0;
        }

        .profile-content {
            display: grid;
            grid-template-columns: 300px 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .profile-content {
                grid-template-columns: 1fr;
            }
        }

        /* Card de informações do usuário */
        .user-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
            text-align: center;
            position: sticky;
            top: 2rem;
        }

        .user-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            margin: 0 auto 1.5rem;
        }

        .user-name {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin: 0 0 0.5rem;
            font-weight: 500;
        }

        .user-username {
            color: #666;
            margin: 0 0 1.5rem;
            font-size: 1rem;
        }

        .user-details {
            text-align: left;
            margin-top: 1.5rem;
        }

        .detail-item {
            margin-bottom: 1rem;
        }

        .detail-label {
            font-size: 0.9rem;
            color: var(--primary-color);
            font-weight: 500;
            display: block;
        }

        .detail-value {
            font-size: 1rem;
            color: var(--text-color);
        }

        .edit-profile-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
        }

        .edit-profile-btn:hover {
            transform: var(--hover-effect);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Seção principal */
        .main-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        /* Card de nível */
        .level-card {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
        }

        .level-card h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-top: 0;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .level-info {
            background: linear-gradient(135deg, #0F044C, rgb(52, 42, 143));
            color: white;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .level-info h3 {
            font-size: 1.2rem;
            margin-top: 0;
            margin-bottom: 0.5rem;
        }

        .level-info p {
            margin: 0;
            font-size: 0.9rem;
        }

        .progress-container {
            margin-top: 1rem;
        }

        .progress-label {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .progress-bar {
            height: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, rgb(149, 254, 79) 90%, rgba(255, 255, 255, 0) 100%);
            border-radius: 5px;
            width: 65%;
            /* Valor dinâmico será ajustado por JS */
        }

        /* Seção de anotações */
        .notes-section {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin: 0;
            font-weight: 500;
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .notes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .note-card {
            background-color: #FFFFFF;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .note-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .note-title {
            font-size: 1.1rem;
            color: var(--primary-color);
            margin: 0 0 0.5rem;
            font-weight: 500;
        }

        .note-meta {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 1rem;
        }

        .note-subject {
            display: inline-block;
            background-color: rgba(15, 4, 76, 0.1);
            color: var(--primary-color);
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
        }

        .note-excerpt {
            font-size: 0.9rem;
            color: var(--text-color);
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .note-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .note-date {
            font-size: 0.8rem;
            color: #666;
        }

        .note-view-btn {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Matérias de interesse */
        .subjects-section {
            background-color: #FFFFFF;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 2rem;
        }

        .subjects-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .subject-tag {
            background-color: rgba(15, 4, 76, 0.1);
            color: var(--primary-color);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        /* Rodapé */
        .profile-footer {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border-color);
        }

        .footer-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1 class="profile-title">Meu Perfil</h1>
        </div>

        <div class="profile-content">
            <!-- Sidebar com informações do usuário -->
            <div class="user-card">
                <div style="border: 2px solid rgb(198, 198, 198); border-radius: 10px;">
                    <br>
                    <h2 class="user-name">{{ $user->name }}</h2>
                    <p class="user-username">nome de utilizador: {{ $user->username }}</p>

                </div>
                <div class="user-details">
                    <div class="detail-item">
                        <span class="detail-label">Email</span>
                        <span class="detail-value">{{ $user->email }}</span>
                    </div>
                        <div class="detail-item">
                            <span class="detail-label">Ano Escolar</span>
                            @if($user->school_year)
                            <span class="detail-value">{{ $user->school_year }}</span>
                            @else
                            <div class="detail-value">
                            <a style="   color: var(--text-color);" href="{{ route('profile.edit') }}">
                                Defina o seu ano escolar 
                            </a>
                        </div>
                    @endif
                        </div>

                    <div class="detail-item">
                        <span class="detail-label">Tipo de Conta</span>
                        <span class="detail-value">{{ $user->isAdmin() ? 'Administrador' : 'Utilizador' }}</span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Método de Login</span>
                        <span class="detail-value">{{ $user->isUsingSocialLogin() ? 'Google' : 'Email/Senha' }}</span>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="edit-profile-btn">Editar Perfil</a><br>
                <a href="{{ route('dashboard') }}" class="edit-profile-btn">Voltar </a>

            </div>

            <!-- Conteúdo principal -->
            <div class="main-content">
                <!-- Card de nível -->
                <div class="level-card">
                    <h2>Meu Progresso</h2>
                    <div class="level-info">
                        @php
                            $points = $user->points;
                            $level = floor($points / 1000);
                            $pointsForNextLevel = 1000 - ($points % 1000);
                            $progressPercentage = ($points % 1000) / 10;
                        @endphp
                        <h3>Você está no nível {{ $level }}</h3>
                        <p>Faltam {{ $pointsForNextLevel }} pontos para o próximo nível</p>

                        <div class="progress-container">
                            <div class="progress-label">
                                <span>{{ $points % 1000 }}/1000 pontos</span>
                                <span>{{ $progressPercentage }}%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                            </div>
                        </div>
                    </div>
                    <p>O seu nível aumenta à medida que partilha anotações com outras pessoas e gosta de outras publicações. <br>Para alcançar o próximo
                nível, continue a partilhar e a interagir com a comunidade!</p>
                        
                </div>

                <!-- Matérias de interesse -->
                <div class="subjects-section">
                    <h2>Meus Interesses</h2>
                    @if($user->subjects->isNotEmpty())
                        <div class="subjects-list">
                            @foreach($user->subjects as $subject)
                                <span class="subject-tag">{{ $subject->name }}</span>
                            @endforeach
                        </div>
                    @elseif($user->subjects_of_interest)
                        <p style="margin-top: 1.5rem;">{{ $user->subjects_of_interest }}</p>
                    @else
                        <div class="subjects-list">
                            <a style="    color: var(--primary-color);" href="{{ route('profile.edit') }}">
                                Defina as disciplinas que está interessado.
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Anotações recentes -->
                <div class="notes-section">
                    <div class="section-header">
                        <h2>Minhas Anotações </h2>
                    </div>

                    <div class="notes-grid">
                        @isset($notes)
                            @if($notes->isEmpty())
                                <p>Você não publicou nenhuma anotação.</p>
                            @else
                            @foreach($notes as $note)
                                <div class="note-card">
                                        <!-- Exemplo de anotações - substitua com dados reais -->
                                        <h3 class="note-title">{{ $note->title }}</h3>
                                        <div class="note-meta">
                                            <span>Dificuldade: {{ $note->topic_difficulty }}</span>
                                        </div>
                                        <span class="note-subject">{{ $note->subject }}</span>
                                        <div class="note-actions">
                                            <span class="note-date">Publicado {{ $note->created_at->diffForHumans() }}</span>
                                            <a href="{{ url('/note/' . $note->slug) }}" class="note-view-btn">Ver</a>
                                        </div>
                                    </div>
                                    @endforeach
                            @endif

                        @endisset

                    </div>
                </div>

                <!-- Anotações salvas -->
                <div class="notes-section">
                    <div class="section-header">
                        <h2>Anotações Guardadas</h2>
                        <a href="{{ route('saved.notes.index') }}" class="view-all">Ver todas</a>
                    </div>

                    <div class="notes-grid">
                        @isset($SavedNotes)
                            @if($SavedNotes->isEmpty())
                                <p>Você não guardou nenhuma anotação.</p>
                            @else
                                @foreach($SavedNotes as $note)
                                    <div class="note-card">
                                        <h3 class="note-title">{{$note->title}}</h3>
                                        <div class="note-meta">
                                            <span>Dificuldade: {{$note->topic_difficulty}}</span>
                                            @if($note->user)
    <span>Por: {{ $note->user->name }}</span>
@endif

                                        </div>
                                        <span class="note-subject">{{$note->subject}}</span>
                                        <div class="note-actions">
                                            <a href="{{ url('/note/' . $note->slug) }}" class="note-view-btn">Ver</a>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        // Atualiza dinamicamente a barra de progresso
        document.addEventListener('DOMContentLoaded', function () {
            const progressFill = document.querySelector('.progress-fill');
            const progressPercentage = {{ $progressPercentage }};
            progressFill.style.width = progressPercentage + '%';
        });
    </script>
</body>

</html>