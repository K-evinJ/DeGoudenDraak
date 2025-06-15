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
    <div class="flex">
        <img src="images/goodpay.png" alt="" class="w-40 h-20 mx-2 mt-2 mb-1"/>
        @if(Auth::Check())
            <div class="flex justify-center items-start w-500">
                <a href="{{ route('employee.cashRegister') }}" class="text-center border border-blue-600 w-42 pb-1 rounded-lg bg-blue-100 mx-2 mt-3 text-lg text-blue-600 font-bold">Kassa</a>
                <a href="#" class="text-center border border-blue-600 w-42 pb-1 rounded-lg bg-blue-100 mx-2 mt-3 text-lg text-blue-600 font-bold">Gerechten</a>
                <a href="#" class="text-center border border-blue-600 w-42 pb-1 rounded-lg bg-blue-100 mx-2 mt-3 text-lg text-blue-600 font-bold">Verkoop Overzicht</a>
                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-center border border-blue-600 w-42 pb-1 rounded-lg bg-blue-100 mx-10 mt-3 text-lg text-blue-600 font-bold">Log Uit</button>
                    </form>
                </div>
            </div>
        @endif
    </div>
    <hr class="mx-2 h-1 bg-blue-600 border-0">
    <div class="font-[chinesetakeaway-employee]">
        {{ $slot }}
    </div>
</body>

</html>