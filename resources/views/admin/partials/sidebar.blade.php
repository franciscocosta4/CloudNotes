<div class="sidebar sidebar-style-1" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <!-- <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('admin/assets/img/kaiadmin/logo_light.svg') }}" alt="Admin" class="navbar-brand" height="20">
            </a> -->
                <!-- Kaiadmin JS -->
    <script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script>
            <a href="{{ route('admin.dashboard') }}" >
                <h4 id="sidebar-title" class=" text-white ">
                CloudNotes
                </h4>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#users">
                        <i class="fas fa-users"></i>
                        <p>Utilizadores</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#usersList">
                                    <span class="sub-item" >Lista de Utilizadores</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.create') }}">
                                    <span class="sub-item">Adicionar Utilizador</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#notes">
                        <i class="fas fa-sticky-note"></i>
                        <p>Anotações</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="notes">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#anotacoes">
                                    <span class="sub-item">Lista de Anotações</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#Disciplinas">
                        <i class="fas fa-book"></i>
                        <p>Disciplinas</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="Disciplinas">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#subjects">
                                    <span class="sub-item">Lista de Disciplinas</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.subjects.create') }}">
                                    <span class="sub-item">Adicionar uma Disciplina</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                <a data-bs-toggle="collapse" href="#logshref">
                        <i class="fas fa-history"></i>
                        <p>Logs de Acesso</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="logshref">
                        <ul class="nav nav-collapse">
                             <li>
                                <a href="#logs">
                                    <span class="sub-item">Logs de Acesso a publicações</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pointshref">
                        <i class="fas fa-bullseye"></i>
                        <p>Logs de Pontos</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="pointshref">
                        <ul class="nav nav-collapse">
                             <li>
                                <a href="#points">
                                    <span class="sub-item">Logs de atribuição de pontos</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const title = document.getElementById("sidebar-title");
    const toggleButtons = document.querySelectorAll(".toggle-sidebar, .sidenav-toggler");

    let isCollapsed = false; // Estado da sidebar

    //* Função para esconder/mostrar a sidebar inteira
    toggleButtons.forEach(button => {
        button.addEventListener("click", function () {
            isCollapsed = !isCollapsed;
            sidebar.classList.toggle("collapsed");

            if (isCollapsed) {
                title.style.display = "none"; // Esconde o título
            } else {
                title.style.display = "block"; // Mostra o título
            }
        });
    });

    //* Le se o rato passou por cima da sidebar e mostra o título se estiver colapsada
    sidebar.addEventListener("mouseenter", function () {
        if (isCollapsed) {
            title.style.display = "block";
        }
    });

    //* Quando o rato sai da sidebar, esconde o título se ainda estiver colapsada
    sidebar.addEventListener("mouseleave", function () {
        if (isCollapsed) {
            title.style.display = "none";
        }
    });
});


</script>