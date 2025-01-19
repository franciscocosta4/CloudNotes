<style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FFFFFF;
            color: #333;
            line-height: 1.6;
            animation: fadeInPage 2s ease-out; /* Animação para a página toda */
        }

        @keyframes fadeInPage {
            from {
                opacity: 0;
            }
            to {     
                opacity: 1;
            }
        }

        a {
            text-decoration: none;
            cursor: pointer;
        }

        /* Header Styles */
        header {
            background-color: white;
            color: black;
            padding: 15px 20px;
            border-bottom: 2px solid #E0E0E0;
        }

        header .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        header h1 {
            font-size: 24px;
            font-weight: bold;
            color: #0F044C;
        }

        header a {
            color: black;
            padding: 10px 20px;
            font-weight: normal;
            margin-left: 10px;
            transition: color 0.3s ease;
            font-family: 'Arial', sans-serif;
        }

        header a:hover {
            color: #0F044C;
        }

        /* Main Content Styles */
        main {
            text-align: center;
            padding: 80px 20px;
            animation: fadeInPage 2s ease-out;
        }

        main h2 {
            font-size: 60px;
            color: #0F044C;
            margin-bottom: 20px;
        }

        main p {
            font-size: 18px;
            color: #666;
            margin-bottom: 40px;
        }

        .button-group a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .button-group .register {
            background-color: #0F044C;
            color: white;
        }

        .button-group .register:hover {
            background-color: #0d033b;
        }

        .button-group .login {
            background-color: white;
            color: #0F044C;
            border: 2px solid #0F044C;
        }

        .button-group .login:hover {
            background-color: #f0f0f0;
        }

        .button-group .more {
            background-color: #f0f0f0;
            color: #0F044C;
        }

        .button-group .more:hover {
            background-color: #e0e0e0;
        }

        /* Dashboard Image Styles */
        .dashboard-preview {
            margin: 40px auto;
            max-width: 800px;
            text-align: center;
            animation: slideInImage 2.5s ease-out 0.5s; /* Animação com atraso para a imagem */
        }

        @keyframes slideInImage {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .dashboard-preview img {
            max-width: 100%;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* About Section */
        #sobre {
            background-color: #f9f9f9;
            padding: 60px 20px;
        }

        #sobre h3 {
            font-size: 28px;
            color: #0F044C;
            margin-bottom: 20px;
        }

        #sobre p {
            font-size: 18px;
            color: #555;
            max-width: 800px;
            margin: 0 auto;
        }

        /* Footer Styles */
        footer {
            background-color: #DDD;
            color: black;
            text-align: center;
            padding: 15px 20px;
        }

        footer p {
            font-size: 14px;
        }
    </style>

<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <img src="/images/dashboard.jpg" alt="Pré-visualização da Dashboard do CloudNotes">
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
