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
    <div class="flex text-nowrap bg-[rgba(255,255,255,0.5)] shadow-sm rounded-lg p-5">
        <form action="{{ route('dishes') }}" class="flex w-full gap-x-10">
            <div class="flex w-full gap-x-3 items-center">
                <strong class="text-lg text-center">Favorieten</strong>
                <select name="favoriteSort" id="favoriteSort" class="shadow-sm p-2 rounded-lg bg-white">
                    <option value="name" @selected($options['favoriteSort'] === 'name')>Alphabetisch</option>
                    <option value="number" @selected($options['favoriteSort'] === 'number')>Nummering</option>
                </select>
                <select name="favoriteOrder" id="favoriteOrder" class="shadow-sm p-2 rounded-lg bg-white">
                    <option value="asc" @selected($options['favoriteOrder'] === 'asc')>Oplopend</option>
                    <option value="desc" @selected($options['favoriteOrder'] === 'desc')>Aflopend</option>
                </select>
            </div>
            <div class="flex w-full gap-x-3 items-center">
                <strong class="text-lg text-center">Alle Gerechten</strong>
                <select name="normalSort" id="normalSort" class="shadow-sm p-2 rounded-lg bg-white">
                    <option value="name" @selected($options['normalSort'] === 'name')>Alphabetisch</option>
                    <option value="number" @selected($options['normalSort'] === 'number')>Nummering</option>
                </select>
                <select name="normalOrder" id="normalOrder" class="shadow-sm p-2 rounded-lg bg-white">
                    <option value="asc" @selected($options['normalOrder'] === 'asc')>Oplopend</option>
                    <option value="desc" @selected($options['normalOrder'] === 'desc')>Aflopend</option>
                </select>
            </div>
            <button type="submit" class="text-nowrap bg-white shadow-sm px-2 py-1 rounded hover:bg-red-50 cursor-pointer">Sorteren</button>
        </form>
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