<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KlikTumbas - @yield('title', 'Dashboard')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            background-color: #f7f7f7;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .navbar-custom {
            background-color: #0094f9;
        }

        .navbar-brand span:first-child {
            color: white;
            font-weight: bold;
        }

        .navbar-brand span:last-child {
            color: #ffff00;
            font-weight: bold;
        }

        footer {
            background-color: #0094f9;
            color: white;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    @include('layouts.header')

    {{-- KONTEN --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('layouts.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
