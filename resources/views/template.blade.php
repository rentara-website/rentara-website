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

    <main class="grow">
        @yield('content')
    </main>

    @include('footer')

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });

        const navbar = document.getElementById('navbar');

        function refreshIcons() {
            if (window.lucide) {
                lucide.createIcons();
            }
        }

        function handleNavbar() {
            if (window.scrollY > 20) {
                navbar.classList.add('fixed', 'top-0', 'left-0', 'shadow-md', 'border-b', 'border-gray-100');
                navbar.classList.remove('relative');
                document.body.classList.add('pt-[88px]');
            } else {
                navbar.classList.remove('fixed', 'top-0', 'left-0', 'shadow-md', 'border-b', 'border-gray-100');
                navbar.classList.add('relative');
                document.body.classList.remove('pt-[88px]');
            }

            refreshIcons();
        }

        window.addEventListener('scroll', handleNavbar);
        window.addEventListener('load', function () {
            handleNavbar();
            refreshIcons();
        });
    </script>
</body>
</html>