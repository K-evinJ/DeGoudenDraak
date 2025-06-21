@props(['dishes' => [], 'action' => 'favorite'])

@foreach ($dishes as $dish)
    <div class="flex justify-between rounded-lg bg-[rgba(255,255,255,0.3)] p-3 shadow-sm gap-3">
        <div class="flex items-center gap-3">
            <div class="flex flex-col items-start">
                <strong class="text-nowrap">{{ $dish->number }}{{ $dish->menu_addition ?? '' }}. {{ $dish->name }}</strong>
                <strong class="text-lg">€ {{ number_format($dish->price, 2, ',', '.') }}</strong>
            </div>
            <i class="self-start">{{ $dish->description ?? '' }}</i>
        </div>
        <form action="{{ route($action) }}" method="POST" class="self-center">
            @csrf
            <input type="hidden" name="dish" value="{{ $dish->id }}">
            <button type="submit" class="text-nowrap bg-gray-50 shadow-sm px-2 py-1 rounded hover:bg-red-50 cursor-pointer transition">{{ $slot }}</button>
        </form>
    </div>
@endforeach
