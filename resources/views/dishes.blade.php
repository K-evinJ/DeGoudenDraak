<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerechten</title>
    @vite('resources/css/app.css')
</head>

<body class="font-[chinese] p-10 flex flex-col items-center h-[100vh]">
    <img src="{{ asset('images/menu-pdf-background.png') }}" class="fixed z-[-1] w-full h-full top-0 left-0">
    <div class="flex flex-wrap gap-5">
        <div class="flex flex-col justify-center bg-[rgba(255,255,255,0.5)] shadow-sm rounded-lg p-3 gap-y-2">
            <a href="{{ route('download.menu') }}" class="p-2 py-1 rounded-lg text-nowrap bg-white hover:bg-red-50">Download Menu</a>
            <a href="{{ route('menu') }}" class="p-2 py-1 rounded-lg text-nowrap bg-white hover:bg-red-50 cursor-pointer transition">Terug</a>
        </div>
        <div class="flex text-nowrap bg-[rgba(255,255,255,0.5)] shadow-sm rounded-lg p-5">
            <form action="{{ route('dishes') }}" class="flex w-full gap-x-10 items-end">
                <x-sort-input :sort="'favoriteSort'" :order="'favoriteOrder'" :options="$options">Favorieten</x-sort-input>
                <x-sort-input :sort="'normalSort'" :order="'normalOrder'" :options="$options">Alle Gerechten</x-sort-input>
                <button type="submit" class="text-nowrap bg-white shadow-sm p-2 py-1 rounded hover:bg-red-50 cursor-pointer transition">Sorteren</button>
            </form>
        </div>
    </div>
    <div class="flex flex-col overflow-y-scroll h-full w-[80vw] rounded p-5 gap-y-2">
        @if (!$favorites->isempty())
            <strong class="text-lg text-center">Favorieten</strong>
        @endif
        <x-dish-row :types="$favorites" :action="'unfavorite'">Verwijder favoriet</x-dish-row>
        @if (!$favorites->isempty())
            <hr class="border-1 border-dashed my-5">
        @endif
        <x-dish-row :types="$nonFavorites" :action="'favorite'">Maak favoriet</x-dish-row>
    </div>
</body>

</html>
