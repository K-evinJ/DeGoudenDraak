<x-layout>
    <main class="flex flex-col gap-1 text-white font-[chinese] text-[20px]">
        <a href="{{ route('dishes') }}" class="bg-[url(/public/images/menu_bg_gradient.png)] border-r-1 border-b-1 border-white hover:cursor-pointer h-7 w-fit px-3 text-center self-end">
            Actueel Menu
        </a>
        <div class="self-center border-1">
            <img src="{{ asset('images/restaurant-menukaart-1-2.jpg') }}" alt="menu1">
            <img src="{{ asset('images/restaurant-menukaart-1.jpg') }}" alt="menu2">
        </div>
    </main>
</x-layout>