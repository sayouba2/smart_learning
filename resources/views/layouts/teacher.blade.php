<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles') <!-- Injection ici -->
    <title>Tableau de bord enseignant</title>
</head>
<body>
    <header>
        <nav>
            <!-- Ici ton menu de navigation -->
        </nav>
    </header>

    <main>
        @yield('content') <!-- Contenu spécifique au dashboard -->
    </main>

    <footer>
        <!-- Pied de page -->
    </footer>
</body>
</html>
