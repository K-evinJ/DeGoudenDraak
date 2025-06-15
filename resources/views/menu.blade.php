<x-layout>

    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    @endsection

    <div class="bg-[#ff0000] mx-[50px] my-[15px]">
        <header class="flex justify-evenly items-center mb-[-5px]">
            <x-header-logo></x-header-logo>
            <a href="#" class="text-[yellow] font-bold font-[chinese] text-[16px] overflow-hidden whitespace-nowrap">Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!</a>
            <x-header-logo></x-header-logo>
        </header>
        <div class="flex justify-between mx-[2px]">
            <img src="{{ asset('images/fancy-corner.svg') }}" alt="corner" class=" size-30">
            <div class="w-[88%] border-[yellow] border-t-4 border-b-4 p-3 self-start mt-3"></div>
            <img src="{{ asset('images/fancy-corner.svg') }}" alt="corner" class=" scale-x-[-1] size-30">
        </div>
        <div class="flex justify-between">
            <div class="border-[yellow] border-l-4 border-r-4 p-[14.5px] ms-[8px] my-[-16px]"></div>
            <div class="flex flex-col w-full mx-12">
                <div class="flex justify-between">
                    <img src="{{ asset('images/dragon-small.png') }}" alt="dragon" class="h-[200px]">
                    <div class="flex flex-col items-center">
                        <h2 class="text-[yellow] font-[chinese] text-[40px] font-bold text-center">Chinees Indische Specialiteiten</h2>
                        <h1 class="text-[yellow] font-[chinese] text-[50px] font-bold text-center">De Gouden Draak</h1>
                        <div class="flex border-1 gap-[2px] font-[chinese] text-[20px] p-[2px] text-white">
                            <button class="bg-[url(/public/images/menu_bg_gradient.png)] border-1 border-white px-7 h-6 flex items-center">Menukaart</button>
                            <button class="bg-[url(/public/images/menu_bg_gradient.png)] border-1 border-white px-7 h-6 flex items-center">Nieuws</button>
                            <button class="bg-[url(/public/images/menu_bg_gradient.png)] border-1 border-white px-7 h-6 flex items-center">Contact</button>
                        </div>
                    </div>
                    <img src="{{ asset('images/dragon-small-flipped.png') }}" alt="dragon" class="h-[200px]">
                </div>
                <div class="flex">
                    <div class="w-[50px]"></div>
                    <div class="self-center border-1 mt-[54px]">
                        <img src="{{ asset('images/restaurant-menukaart-1-2.jpg') }}" alt="menu1">
                        <img src="{{ asset('images/restaurant-menukaart-1.jpg') }}" alt="menu2">
                    </div>
                </div>
                <a href="" class="self-center mt-5 font-[chinese] text-[yellow]">Naar Contact</a>
            </div>
            <div class="border-[yellow] border-l-4 border-r-4 p-[14.5px] me-[8px] my-[-16px]"></div>
        </div>
        <div class="flex justify-between mb-[7px] mx-[2px]">
            <img src="{{ asset('images/fancy-corner.svg') }}" alt="corner" class="scale-y-[-1] size-30">
            <div class="w-[88%] border-[yellow] border-t-4 border-b-4 p-3 self-end mb-3"></div>
            <img src="{{ asset('images/fancy-corner.svg') }}" alt="corner" class="scale-y-[-1] scale-x-[-1] size-30">
        </div>
    </div>
    <div class="h-[0.1px]"></div>
</x-layout>