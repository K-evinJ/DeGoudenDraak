<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Golden Dragon</title>
    @vite('resources/css/app.css')

    @yield('styles')
    @yield('scripts')
</head>
<body class="h-screen w-screen">
    {{ $slot }}
</body>
</html>