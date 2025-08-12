<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #e0e0e0;
            min-height: 100vh;
        }
        
        /* Fondo general (imagen) */
        .main-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("{{ asset('layouts/images/boliviainteligente-QPu42AAJ5ZY-unsplash.jpg') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            z-index: -2;
        }
        
        /* Fondo negro semitransparente general */
        .overlay-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
        
        .main-content {
            position: relative;
            min-height: 100vh;
            padding: 2rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Fondo general -->
    <div class="main-background"></div>
    <div class="overlay-background"></div>
    
    <!-- Contenido principal -->
    <div class="main-content">
        @yield('content')
    </div>
    
    @stack('scripts')
</body>
</html>