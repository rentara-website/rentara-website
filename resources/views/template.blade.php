<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentara - {{$title}}</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="icon" href="/images/Rentara-removebg-preview1.png" type="image/x-icon">
</head>
<body class="font-poppins flex flex-col min-h-screen overflow-x-hidden">
    <nav>@include('navbar')</nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('footer')

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>