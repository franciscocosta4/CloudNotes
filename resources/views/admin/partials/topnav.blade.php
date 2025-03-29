<nav class="navbar navbar-header navbar-expand-lg bg-white shadow-sm" style="height:70px;">
    <div class="container-fluid d-flex align-items-center">

        <!-- Campo de Pesquisa -->
        <form class=" mt-3 d-none d-md-flex me-auto" style="max-width: 250px;">
            <div class="input-group" style="border:1px solid #e6e7e9; border-radius: 5px;">
                <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" class="form-control bg-light border-0" placeholder="Procurar ...">
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
                <a class="nav-link" href="#" id="notifDropdown" data-bs-toggle="dropdown"
                    onclick="markNotificationsAsSeen(event)">
                    <i class="fas fa-bell text-muted"></i>
                    @php
                        $adminActionQuant = App\Models\AdminAction::where('seen', 0)->count();
                    @endphp

                    @if ($adminActionQuant > 0)
                        <span
                            class="badge badge-pill bg-success position-absolute translate-middle p-1">{{ $adminActionQuant }}</span>
                    @endif

                </a>
                <script>
                    //* este script basicamente manda para o controller uma req para ele marcar as notificações que ainda nao foram vistas como vistas 
                    //? esta é a unica solução de mandar o form sem dar refresh e sem sair do pagina 
                    function markNotificationsAsSeen(event) {
                        event.preventDefault(); // Previne o comportamento padrão do link

                        // Faz uma chamada AJAX para a rota 'admin.notifications.update'
                        fetch("{{ route('admin.notifications.update') }}", {
                            method: "POST", // Utiliza o método POST para atualizar as notificações
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}" // Inclui o token CSRF para proteção
                            },
                            body: JSON.stringify({
                                // neste caso nao mandamos nada para o controller 
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                // Lógica após a resposta bem-sucedida
                                console.log("Notificações marcadas como vistas", data);
                                // Atualize a contagem de notificações (se necessário)
                                document.querySelector(".badge").textContent = "0"; // Zera a quantidade na bolinha verde
                            })
                            .catch(error => {
                                console.error("Erro ao marcar notificações como vistas", error);
                            });
                    }
                </script>




                <ul class="dropdown-menu notif-box animated fadeIn">
                    <li>
                        <div class="dropdown-title">Você tem novas notificações</div>
                    </li>

                    <li>
                        <div class="notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                @php
                                    // Buscar apenas as notificações não vistas
                                    $adminActions = App\Models\AdminAction::where('seen', 0)->latest()->get();
                                @endphp

                                @if($adminActions->isEmpty())
                                    <p>Não há notificações por ver.</p>
                                @else
                                                        @foreach($adminActions as $adminAction)
                                                                                <a href="#">
                                                                                    <div
                                                                                        class="notif-icon 
                                                                                                                {{ preg_match('/\b(excluída|excluído)\b/i', $adminAction->message) ? 'notif-danger' :
                                                            (preg_match('/\b(criada|criado)\b/i', $adminAction->message) ? 'notif-success' : 'notif-primary') }}">
                                                                                        <i class=" 
                                                                                                                    {{ preg_match('/\b(excluída|excluído)\b/i', $adminAction->message) ? 'fas fa-trash-alt' :
                                                            (preg_match('/\b(criada|criado)\b/i', $adminAction->message) ? 'fa fa-user-plus' :
                                                                'fas fa-hdd') }}">
                                                                                        </i>
                                                                                    </div>
                                                                                    <div class="notif-content" style="margin-right: 0; padding-right: 0;">
                                                                                        <span class="block">
                                                                                            {{ $adminAction->admin_id ? \App\Models\User::find($adminAction->admin_id)->name : 'Desconhecido' }}:
                                                                                            <br>'{{ $adminAction->message }}'
                                                                                        </span>
                                                                                        <span class="time">{{ $adminAction->created_at->format('d/m/Y H:i') }}</span>
                                                                                    </div>
                                                                                </a>
                                                        @endforeach
                                @endif

                                <!-- <a href="#">
                            <div class="notif-icon notif-success">
                              <i class="fa fa-comment"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block">
                                Rahmad commented on Admin
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-img">
                              <img
                                src="../assets/img/profile2.jpg"
                                alt="Img Profile"
                              />
                            </div>
                            <div class="notif-content">

                              <span class="block">
                                Reza send messages to you
                              </span>
                              <span class="time">12 minutes ago</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="notif-icon notif-danger">
                              <i class="fa fa-heart"></i>
                            </div>
                            <div class="notif-content">
                              <span class="block"> Farrah liked Admin </span>
                              <span class="time">17 minutes ago</span>
                            </div>
                          </a> -->
                            </div>
                        </div>
                    </li>
                    <li>
                        <a class="see-all" href="{{ url('admin/notifications') }}">Ver todas as notificações<i
                                class="fa fa-angle-right"></i>
                        </a>
                    </li>
                </ul>
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
                    <img src="{{ asset('admin/assets/img/eu.jpg') }}" class="rounded-circle me-2" width="30"
                        height="30">
                    <span class="fw-bold text-dark">Olá, {{ Auth::user()->name ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="{{ route('admin.profile.edit') }}">Meu Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Definições</a></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item" type="submit"><a
                                    href="{{ route('logout') }}"></a>Sair</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>