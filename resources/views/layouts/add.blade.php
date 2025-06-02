<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Modifier Réservation')</title>
    <!-- Tailwind CSS v4 Play CDN avec plugins -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
    @yield('head')
</head>
<body class="bg-gray-100">
    @yield('content')

    @yield('scripts')
</body>
</html>
