<x-employeeLayout>
    <div class="flex h-[calc(100vh-7rem)]">
        <div class="overflow-y-auto w-[90%] m-5 mx-auto border border-blue-400 rounded-l-lg p-5">
            @foreach($groupedDishes as $type => $dishes)
                <h2 class="font-semibold text-center text-lg">{{ strtoupper($type) }}</h2>
                @foreach($dishes as $dish)
                    <div class="flex justify-between my-1 text-sm">
                        <div class="flex w-full">
                            <p class="w-1/10">{{ $dish->full_number }}.</p>
                            <p class="w-3/10">{{ $dish->name }}</p>
                            <p class="w-6/10">{{ $dish->description  }}</p>
                        </div>
                        <p class="ms-4">€{{ $dish->current_price }}</p>
                    </div>
                    <hr class="m-1 text-gray-300">
                @endforeach
            @endforeach
        </div>
    </div>
</x-employeeLayout>