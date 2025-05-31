<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titre')</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/icons/boxicons.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/icons/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>
<body>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
