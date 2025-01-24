<link rel="preload" href="{{ asset('css/welcome.css') }}" as="style" onload="this.rel='stylesheet'">
<!-- noscript garante q o estilo carrega msm com o js desligado -->
<noscript>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</noscript>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" as="image" href="/images/dashboard.jpg" >
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <title>CloudNotes - Bem-vindo</title>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <h1>CloudNotes</h1>
            <div>
                <a href="{{ route('login') }}">Iniciar Sessão</a>
                <a href="{{ route('register') }}">Registar</a>
                <a href="#sobre">Características</a>
                <a href="#sobre">Objetivo</a>
                <a href="javascript:location.reload();" title="Atualizar página">Atualizar</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <h2>Aprenda melhor</h2>
        <p>Transforme a forma como organiza e partilha as suas anotações com o CloudNotes.</p>
        <div class="button-group">
            <a href="{{ route('register') }}" class="register">Registar</a>
            <a href="{{ route('login') }}" class="login">Iniciar Sessão</a>
            <a href="#sobre" class="more">Saiba Mais</a>
        </div>

        <!-- Dashboard Preview -->
        <div class="dashboard-preview">
            <img  loading="lazy" src="/images/dashboard.jpg" alt="Pré-visualização da Dashboard do CloudNotes">
        </div>
    </main>

    <!-- About Section -->
<section id="sobre">
    <h3>Sobre a CloudNotes</h3>
    <p>
        A CloudNotes é uma plataforma inovadora que facilita a gestão e partilha de anotações de forma rápida e segura.
        Com uma interface intuitiva e moderna, pode organizar as suas ideias, colaborar com colegas e aceder às suas notas em qualquer lugar.
        Seja estudante, profissional ou alguém que procura melhorar a organização, a CloudNotes é a solução ideal para aumentar a sua produtividade.
    </p>
    <br>
    <br>
    <h3>Objetivo</h3>
    <p>A CloudNotes tem como objetivo facilitar a partilha e consulta de anotações entre estudantes, promovendo a colaboração e eficiência nos estudos.</p>
    <br>
    <br>
    <h3>Funcionalidades</h3>
    <p><strong>Pesquisa Avançada:</strong> Localize anotações de forma rápida utilizando filtros como disciplina e nível de dificuldade.</p>
    <p><strong>Guardar Anotações:</strong> Guarde as suas anotações favoritas para consultas futuras.</p>
    <p><strong>Sistema de Pontos:</strong> Ganhe pontos ao partilhar conteúdos e suba de nível na aplicação.</p>
</section>


    <!-- Footer -->
    <footer>
        <p>&copy; 2024 CloudNotes. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
