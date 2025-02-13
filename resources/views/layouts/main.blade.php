<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome (Ícones) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">

    <!-- KaiAdmin CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/kaiadmin.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/custom.css') }}">

     <!-- Custom Styles -->
     <link rel="stylesheet" href="{{ asset('admin/assets/css/fonts.css') }}">
</head>
<body>
    @include('partials.navbar') <!-- Navbar do site -->
    
    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer') <!-- Footer do site -->

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
