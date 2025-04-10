<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap"
    rel="stylesheet">
  <!-- CSS Files -->
  <link rel="preload" href="{{ asset('admin/assets/js/core/jquery-3.7.1.min.js') }}" as="script">
  <script src="{{ asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>

  <link rel="preload" href="{{ asset('admin/assets/css/bootstrap.min.css') }}" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
  <link rel="preload" href="{{ asset('admin/assets/css/plugins.min.css') }}" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.min.css') }}">
  <noscript>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/plugins.min.css') }}">
  </noscript>
  <link rel="preload" href="{{ asset('admin/assets/css/fonts.css') }}" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
</head>
<body>
  <div class="wrapper">
    @include('admin.partials.sidebar') <!-- Sidebar Estilo 2 -->
    <div class="main-panel">
      @include('admin.partials.topnav') <!-- Top Navbar Padrão -->
      <div class="content">
        @yield('content') <!-- Conteúdo da página -->
      </div>
      @if(empty($hideFooter))
        @include('admin.partials.footer') <!-- Footer -->
      @endif
    </div>
  </div>
  <!-- End Custom template -->
  </div>
  <!-- Toast Container -->
  <div class="toast-container position-fixed top-0 end-0 p-3">
    <div id="liveToast" class="toast " role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header ">
        <strong class="me-auto" style="font-weight:bold;">Sistema</strong>
        <small>agora</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body " style="color:black;">
        <small>mensagem:</small><br>
        <span id="toastMessage"></span>
      </div>
    </div>
  </div>
  <!-- Script para Mostrar o Toast -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      let toastMessage = "{{ session('success') }}";
      if (toastMessage) {
        let toastElement = document.getElementById('liveToast');
        document.getElementById('toastMessage').innerText = toastMessage;
        let toast = new bootstrap.Toast(toastElement);
        toast.show();
      }
    });
  </script>
  <!--   Core JS Files   -->
  <!-- <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
  <script src="{{ asset('admin/assets/js/core/popper.min.js') }}" defer></script>
  <!-- Kaiadmin JS -->
  <script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script>
  <!-- jQuery Scrollbar -->
  <script src="{{ asset('admin/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}" defer></script>

  <!-- Chart JS -->
  <!-- <script src="{{ asset('admin/assets/js/plugin/chart.js/chart.min.js') }}"></script> -->

  <!-- jQuery Sparkline -->
  <!-- <script src="{{ asset('admin/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script> -->

  <!-- Chart Circle -->
  <!-- <script src="{{ asset('admin/assets/js/plugin/chart-circle/circles.min.js') }}"></script> -->

  <!-- Datatables -->
  <!-- <script src="{{ asset('admin/assets/js/plugin/datatables/datatables.min.js') }}"></script> -->

  <!-- Bootstrap Notify -->
  <!-- COMENTADO POIS NAO QUERO NOTIFICAÇÕES  -->
  <!-- <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>  -->

  <!-- jQuery Vector Maps -->
  <!-- <script src="{{ asset('admin/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugin/jsvectormap/world.js') }}"></script> -->

  <!-- Sweet Alert -->
  <script src="{{ asset('admin/assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>  <!--  está a ser usado, nao tirar-->


</body>

</html>