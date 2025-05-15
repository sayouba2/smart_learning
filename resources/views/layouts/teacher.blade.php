<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
    @livewireStyles
    <title>Tableau de bord enseignant</title>
</head>
<body>
    <header>
        <nav><!-- Menu de navigation --></nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer><!-- Pied de page --></footer>

    <!-- Scripts dans cet ordre précis -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @livewireScripts
    
    <!-- Livewire Charts CDN -->
    <script src="https://cdn.jsdelivr.net/npm/livewire-charts@1.0.0/dist/livewire-charts.js"></script>
    
    @stack('scripts')
</body>
</html>