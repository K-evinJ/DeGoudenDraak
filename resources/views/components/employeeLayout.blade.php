<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Werknemersportaal</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @yield('styles')
    <script src="{{ asset('js/CashDesk.js') }}" defer></script>
</head>

<body>
    <img src="images/goodpay.png" alt="" class="w-40 h-20 mx-2 mt-2 mb-1"/>
    <hr class="mx-2 h-1 bg-blue-600 border-0">
    {{ $slot }}
</body>

</html>