<div class="sidebar sidebar-style-2" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <!-- <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('admin/assets/img/kaiadmin/logo_light.svg') }}" alt="Admin" class="navbar-brand" height="20">
            </a> -->
            <a href="{{ route('admin.dashboard') }}" >
                <h3 id="sidebar-title" class=" text-white ">
                CloudNotes
                </h3>
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
                                <a href="">
                                    <span class="sub-item">Lista de Anotações</span>
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
            </ul>
        </div>
    </div>
</div>

<script>

    //* PARA ESCONDER/MOSTRAR 'CloudNotes' AO INTERAGIR COM SIDEBAR
  document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const title = document.getElementById("sidebar-title");
    const toggleButtons = document.querySelectorAll(".toggle-sidebar, .sidenav-toggler");

    let isCollapsed = false; // Estado da sidebar

    //* Função para esconder/mostrar o título ao clicar no botão
    toggleButtons.forEach(button => {
        button.addEventListener("click", function () {
            isCollapsed = !isCollapsed;
            sidebar.classList.toggle("collapsed");

            if (isCollapsed) {
                title.style.display = "none"; // Esconde título
            } else {
                title.style.display = "block"; // Mostra título
            }
        });
    });

    //* le se o rato passou por sima e caso tenha passado mostra o titulo
    sidebar.addEventListener("mouseenter", function () {
        if (isCollapsed) {
            title.style.display = "block";
        }
    });

    //* Quando o rato sai da sidebar, esconde o título 
    sidebar.addEventListener("mouseleave", function () {
        if (isCollapsed) {
            title.style.display = "none";
        }
    });
});

</script>