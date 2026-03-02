<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rentara - {{$title}}</title>
    @vite('resources/css/app.css')
</head>
<body class="font-poppins">
    <nav>@include('navbar')</nav>

    <main class="px-14">
        @yield('content')
    </main>

    <footer class="border-t-2">@include('footer')</footer>
</body>
</html>