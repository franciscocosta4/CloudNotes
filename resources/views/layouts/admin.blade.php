<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

 
    <!-- Font Awesome (Ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <!-- KaiAdmin CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.css') }}">


     <!-- Custom Styles -->
     <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.css') }}">

       <!-- Custom Styles -->
       <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.min.css') }}">
</head>
<body>
    <div class="wrapper">
        @include('admin.partials.sidebar')  <!-- Sidebar Estilo 2 -->

        <div class="main-panel">
            @include('admin.partials.topnav')  <!-- Top Navbar Padrão -->

            <div class="content">
                @yield('content') <!-- Conteúdo da página -->
            </div>

            @include('admin.partials.footer')  <!-- Footer -->
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admin/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/kaiadmin.min.js') }}"></script>
</body>
</html>
