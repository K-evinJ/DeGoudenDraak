<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @vite('resources/css/app.css')

        <title>Menukaart</title>
    </head>
    @php
        $flattenedDishes = collect();

        foreach ($dishTypes as $type => $dishes) {
            $flattenedDishes->push(['isHeader' => true, 'label' => $type]);
            foreach ($dishes as $dish) {
                $flattenedDishes->push(['isHeader' => false, 'dish' => $dish]);
            }
        }

        $chunks = $flattenedDishes->chunk(60);
    @endphp
    <body class="bg-[url('/public/images/menu-pdf-background.png')] [background-size:100%_100%] bg-center h-[100vh] w-[100vw] font-[chinese]">
        @foreach ($chunks as $chunk)
            <main class="p-5 px-10 grid grid-cols-3 gap-x-5 w-full h-[91vh] text-sm leading-tight">
                @foreach ($chunk as $item)
                    @if ($item['isHeader'])
                        <div class="col-span-1 font-bold text-center">{{ $item['label'] }}</div>
                    @else
                        @php $dish = $item['dish']; @endphp
                        <div>
                            <div class="flex justify-between items-center gap-1">
                                <span>{{ $dish->number }}{{ $dish->menu_addition ?? "" }}. {{ $dish->name }}</span>
                                <span class="flex grow border-b border-dotted h-2"></span>
                                <span class="text-right">€ {{ number_format($dish->price, 2, ',', '.') }}</span>
                            </div>
                            <i class="block text-ellipsis text-nowrap overflow-hidden text-xs italic text-gray-800">
                                ({{ $dish->description ?? 'Geen beschrijving.' }})
                            </i>
                        </div>
                    @endif
                @endforeach
            </main>
            @pageBreak
        @endforeach
        <main class="p-5 px-10 grid grid-cols-3 gap-x-5 w-full h-[91vh] text-sm leading-tight">
            <div class="col-span-1 font-bold text-center">Aanbiedingen</div>
            @foreach ($discounts as $discount)
                <div>
                    <div class="flex justify-between items-center gap-1">
                        <span>{{ $discount->dish->number }}{{ $discount->dish->menu_addition ?? "" }}. {{ $discount->dish->name }}</span>
                        <span class="flex grow border-b border-dotted h-2"></span>
                        <span class="text-right">€ <s>{{ number_format($discount->dish->price, 2, ',', '.') }}</s> 
                            {{ number_format($discount->dish->price * (1 - $discount->discount_percentage / 100), 2, ',', '.') }}</span>
                    </div>
                    <i class="block text-ellipsis text-nowrap overflow-hidden text-xs italic text-gray-800">
                        ({{ $discount->dish->description ?? 'Geen beschrijving.' }})
                    </i>
                </div>
            @endforeach
        </main>
        <div class="flex justify-between m-10 pt-5">
            <img src="{{ asset('images/warm-buffet.png') }}" class="h-[50vh]">
            <img src="{{ asset('images/menu-footer.png') }}" class="h-[90vh]">
        </div>
    </body>
</html>