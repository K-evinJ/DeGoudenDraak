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

    $chunks = $flattenedDishes->chunk(60); // Or however many items (headers + dishes) you want per page
@endphp


<body class="bg-[url('/public/images/menu-pdf-background.png')] [background-size:100%_100%] bg-center h-[100vh] w-[100vw] font-[chinese]">
    @foreach ($chunks as $chunk)
        <main class="p-5 px-10 grid grid-cols-3 gap-x-5 w-full h-[91vh] text-sm leading-tight">
            @foreach ($chunk as $item)
                @if ($item['isHeader'])
                    <div class="col-span-3 font-bold text-center mb-1">{{ $item['label'] }}</div>
                @else
                    @php $dish = $item['dish']; @endphp
                    <div>
                        <div class="flex justify-between items-center gap-1">
                            <span>{{ $dish->number }}. {{ $dish->name }}</span>
                            <span class="flex grow border-b border-dotted border-black h-[1px] mt-1 mx-1"></span>
                            <span class="text-right w-16">€ {{ number_format($dish->price, 2) }}</span>
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
    <div class="flex justify-between m-10 pt-5">
        <img src="{{ asset('images/warm-buffet.png') }}" class="h-[50vh]">
        <img src="{{ asset('images/menu-footer.png') }}" class="h-[90vh]">
    </div>
</body>

</html>