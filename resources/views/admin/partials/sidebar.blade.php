<div class="sidebar sidebar-style-2" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <!-- <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="{{ asset('admin/assets/img/kaiadmin/logo_light.svg') }}" alt="Admin" class="navbar-brand" height="20">
            </a> -->
            <a href="{{ route('admin.dashboard') }}" >
                <h2 class=" text-white ">
                CloudNotes
                </h2>
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
                                <a href="">
                                    <span class="sub-item">Lista de Utilizadores</span>
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
                            <li>
                                <a href="{{ route('admin.notes.create') }}">
                                    <span class="sub-item">Criar Anotação</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="#logs">
                        <i class="fas fa-history"></i>
                        <p>Logs de Acesso</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
