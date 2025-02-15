<nav class="navbar navbar-header navbar-expand-lg bg-white shadow-sm" style="height:70px;">
    <div class="container-fluid d-flex align-items-center">
        
        <!-- Campo de Pesquisa -->
        <form class="d-none d-md-flex me-auto" style="max-width: 250px;">
            <div class="input-group">
                <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control bg-light border-0" placeholder="Search ...">
            </div>
        </form>

        <ul class="navbar-nav ms-auto d-flex align-items-center">
            <!-- Ícone de Mensagens -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-envelope text-muted"></i>
                </a>
            </li>

            <!-- Ícone de Notificações -->
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="notifDropdown" data-bs-toggle="dropdown">
                    <i class="fas fa-bell text-muted"></i>
                    <span class="badge badge-pill bg-success position-absolute translate-middle p-1">4</span>
                </a>
            </li>

            <!-- Ícone de Configurações -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-layer-group text-muted"></i>
                </a>
            </li>

            <!-- Perfil do Usuário -->
            <li class="nav-item dropdown">
                <a class="nav-link d-flex align-items-center" href="#" id="userDropdown" data-bs-toggle="dropdown">
                    <img src="{{ asset('admin/assets/img/profile.jpg') }}" class="rounded-circle me-2" width="30" height="30">
                    <span class="fw-bold text-dark">Hi, {{ Auth::user()->name ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="#">Meu Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Definições</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit" ><a href="{{ route('logout') }}"></a>Sair</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
