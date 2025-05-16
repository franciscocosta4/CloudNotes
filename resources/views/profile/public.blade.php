<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de {{ $user->name }} - CloudNotes</title>
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
            font-weight: 600;
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
            font-weight: 600;
        }

        .user-username {
            color: #666;
            margin: 0 0 1.5rem;
            font-size: 1rem;
        }

        .user-stats {
            display: flex;
            justify-content: space-around;
            margin: 1.5rem 0;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin: 0;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #666;
            margin: 0;
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
            font-weight: 600;
        }

        .level-info {
            background: linear-gradient(135deg, #0F044C, #2A3F8F);
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
            background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
            border-radius: 5px;
            width: 65%;
            /* Valor dinâmico será ajustado por JS */
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
            font-weight: 600;
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

        /* Botão de seguir */
        .follow-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            margin-top: 1rem;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        .follow-btn:hover {
            transform: var(--hover-effect);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }

        .follow-btn.following {
            background-color: #6c757d;
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
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1 class="profile-title">Perfil Público</h1>
        </div>

        <div class="profile-content">
            <!-- Sidebar com informações do user -->
            <div class="user-card">
                <div style="border: 2px solid rgb(198, 198, 198); border-radius: 10px;">
                    <br>

                    <h2 class="user-name"> {{ $user->name }}</h2>
                    <p class="user-username"> Nome de utilizador: <br> {{ $user->username }}</p>

                    <!-- Estatísticas do user -->
                    <div class="user-stats">
                        <div class="stat-item">
                            <p class="stat-number">{{ $user->notes()->count() }}</p>
                            <p class="stat-label">Anotações</p>
                        </div>
                    </div>
                </div>
                <div class="user-details">
                    @if($user->school_year)
                        <div class="detail-item">
                            <span class="detail-label">Ano Escolar</span>
                            <span class="detail-value">{{ $user->school_year }}</span>
                        </div>
                    @endif

                    <div class="detail-item">
                        <span class="detail-label">Membro desde</span>
                        <span class="detail-value">{{ $user->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
                <div class="user-details">
                    <span class="detail-label">Tipo de Conta</span>
                    <span class="detail-value">{{ $user->isAdmin() ? 'Administrador' : 'Utilizador' }}</span>
                </div>

                <a href="{{ url()->previous() }}" class="edit-profile-btn">Voltar</a>
            </div>


            <!-- Conteúdo principal -->
            <div class="main-content">
                <!-- Card de nível -->
                <div class="level-card">
                    <h2>Progresso</h2>
                    <div class="level-info">
                        @php
                            $points = $user->points;
                            $level = floor($points / 1000);
                            $pointsForNextLevel = 1000 - ($points % 1000);
                            $progressPercentage = ($points % 1000) / 10;
                        @endphp
                        <h3>Nível {{ $level }}</h3>
                        <p>{{ $points }} pontos acumulados</p>

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
                    <p>Este utilizador ganha pontos ao compartilhar anotações e ajudar outros estudantes.</p>
                </div>

                <!-- Matérias de interesse -->
                @if($user->subjects->isNotEmpty() || $user->subjects_of_interest)
                    <div class="subjects-section">
                        <h2>Interesses Acadêmicos</h2>

                        @if($user->subjects->isNotEmpty())
                            <div class="subjects-list">
                                @foreach($user->subjects as $subject)
                                    <span class="subject-tag">{{ $subject->name }}</span>
                                @endforeach
                            </div>
                        @endif

                        @if($user->subjects_of_interest)
                            <p style="margin-top: 1.5rem;">{{ $user->subjects_of_interest }}</p>
                        @endif
                    </div>
                @endif

                <!-- Anotações públicas -->
                <div class="notes-section">
                    <div class="section-header">
                        <h2>Anotações Públicas</h2>
                    </div>

                    @if($user->notes()->count() > 0)
                        <div class="notes-grid">
                            @foreach($user->notes()->latest()->take(6)->get() as $note)
                                <div class="note-card">
                                    <h3 class="note-title">{{ $note->title }}</h3>
                                    <div class="note-meta">
                                        <span>Dificuldade: {{ $note->topic_difficulty }}</span>
                                        <span>{{ $note->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <span class="note-subject">{{ $note->subject }}</span>
                                    <p class="note-excerpt">{{ Str::limit(strip_tags($note->content), 150) }}</p>
                                    <div class="note-actions">
                                        <span class="note-date">{{ $note->created_at->diffForHumans() }}</span>
                                        <a href="{{ route('notes.show', $note->slug) }}" class="note-view-btn">Ver</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>Este usuário ainda não publicou nenhuma anotação pública.</p>
                    @endif
                </div>

                <!-- Anotações mais populares -->
                <div class="notes-section">
                    <div class="section-header">
                        <h2>Anotações Populares</h2>
                    </div>
                    <div class="notes-grid">
                        @foreach($notesByLikes as $note)
                            <div class="note-card">
                                <h3 class="note-title">{{ $note->title }}</h3>
                                <div class="note-meta">
                                    <span> {{ $note->likes_count }} gostos</span>
                                    <span>{{ $note->created_at->format('d/m/Y') }}</span>
                                </div>
                                <span class="note-subject">{{ $note->subject }}</span>
                                @if(!empty($note->content))
                                    <p class="note-excerpt">{{ Str::limit(strip_tags($note->content), 150) }}</p>
                                @endif

                                <div class="note-actions">
                                    <span class="note-date">{{ $note->created_at->diffForHumans() }}</span>
                                    <a href="{{ route('notes.show', $note->slug) }}" class="note-view-btn">Ver</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>