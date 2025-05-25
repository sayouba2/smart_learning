<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        @stack('styles')
        <!-- Scripts -->
       
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            

            <!-- Page Heading -->
           

            <!-- Page Content -->
            <main>
              @yield('content')
            </main>

        </div>
         @stack('styles')
    </body>
</html>
