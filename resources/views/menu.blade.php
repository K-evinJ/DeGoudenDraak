<x-layout>

    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    @endsection

    <div class="bg-[#ff0000] mx-[50px] my-[15px]">
        <header class="flex justify-evenly items-center">
            <x-header-logo></x-header-logo>
            <a href="#" class="text-[yellow] font-bold">Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!</a>
            <x-header-logo></x-header-logo>
        </header>

    </div>
</x-layout>