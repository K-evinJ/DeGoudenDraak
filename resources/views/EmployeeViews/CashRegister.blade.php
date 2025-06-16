<x-employeeLayout>
    <div class="flex">
        <div class="overflow-y-auto overflow-x-none h-160 w-[60%] m-5 me-0 border border-blue-400 rounded-l-lg p-5">
            @foreach($groupedDishes as $type => $dishes)
                <h2 class="font-semibold text-lg justify-self-center">{{ strtoupper($type) }}</h2>
                    @foreach($dishes as $dish)
                        <div class="flex justify-between items-center my-1 text-sm">
                            <div class="flex w-8/10">
                                <p class="w-2/10">{{ $dish->full_number }}.</p>
                                <p class="w-8/10">{{ $dish->name }}</p>
                            </div>
                            <p>€{{ $dish->current_price }}</p>
                            <button class="addMenuItem px-2 border border-black rounded bg-gray-200 hover:bg-gray-300" value='{{ $dish->id }}'>toevoegen</button>
                        </div>
                    @endforeach
            @endforeach
        </div>
        <div class="h-165 border border-blue-500 m-2 "></div>
        <div>
            <form method="post" action="{{ route('orderCashregister') }}">
                @csrf
            <div class="border border-blue-400 rounded-l mt-5 overflow-y-auto h-144">
                <table class='itemSelectedTable w-full'>
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center font-semibold text-lg pt-5">
                                Bestelling
                            </th>
                        </tr>
                    </thead>
                    <tbody class="flex flex-col">
                        @foreach($groupedDishes as $type => $dishes)
                            @foreach($dishes as $dish)
                                <tr class="flex hidden  menuItem_{{ $dish->id }}" data-price="{{ $dish->current_price }}">
                                    <td class="mx-5 w-10">
                                        <p>{{ $dish->full_number }}.</p>
                                    </td>
                                    <td class="mx-5 w-100">
                                        <p>{{ $dish->name }}</p>
                                    </td>
                                    <td class="mx-5 w-15">
                                        <p>€{{number_format($dish->current_price,2)}}</p>
                                        <p class="hidden subAmount"></p>
                                    </td>
                                    <td>
                                        <input class="border border-gray-400 w-20 rounded" type="number" name="dishes[{{ $dish->id }}]" min="0">
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div id="itemsSelectedTotal" class="p-4 border border-blue-400 rounded w-180">
                <div class="flex items-center">
                <!-- Left side: Totaal text -->
                    <p class="flex-grow font-semibold text-lg">
                        Totaal:
                    </p>

                <!-- Right side: price and buttons -->
                    <div class="flex items-center space-x-6">
                        <div class="text-lg font-semibold flex items-center">
                            <span>€&nbsp;</span>
                            <span class="totalAmount">0,00</span>
                        </div>

                        <div class="flex space-x-2">
                            <button id="payOrder" type="submit" class="px-3 my-1 border border-black rounded bg-gray-200 hover:bg-gray-300 text-sm">
                                Afrekenen
                            </button>
                            </form>
                            <button id="clearOrder" type="button" class="px-3 my-1 border border-black rounded bg-gray-200 hover:bg-gray-300 text-sm">
                                Verwijderen
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="successModal" class="fixed inset-0 z-50 hidden" onclick="closeModal()">
    <!-- Background overlay -->
        <div class="absolute inset-0 bg-black opacity-40"></div>

        <!-- Modal content -->
            <div class="relative z-10 mx-auto mt-70 w-120 bg-white p-8 shadow-lg">
                <div class="flex justify-between items-start">
                    <h2 class="text-sm">{{ session('order_message') }}</h2>
                    <button onclick="closeModal()" class="text-gray-600 text-2xl leading-none hover:text-black">&times;</button>
                </div>
            </div>
        </div>
    </div>
</x-employeeLayout>

@if(session('order_message'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showModal();
        });
    </script>
@endif