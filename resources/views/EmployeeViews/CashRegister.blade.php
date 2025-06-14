<x-employeeLayout>
    <div class="flex">
        <div class="overflow-y-auto h-160 w-280 m-5 border border-blue-400 rounded-l-lg p-5">
            @foreach($groupedDishes as $type => $dishes)
                <h2 class="font-semibold text-2xl justify-self-center">{{ $type }}</h2>
                    @foreach($dishes as $dish)
                        <div class="flex justify-between items-center my-1 text-sm">
                            <div class="flex">
                                <p class="w-30">{{ $dish->full_number }}.</p>
                                <p class="w-100">{{ $dish->name }}</p>
                            </div>
                            <p>€{{ $dish->current_price }}</p>
                            <button class="addMenuItem px-2 border border-black rounded bg-gray-200" value='{{ $dish->id }}'>toevoegen</button>
                        </div>
                    @endforeach
            @endforeach
        </div>
        <div>
            <form>
            <table class='itemSelectedTable h-148 w-184 overflow-y-auto border border-blue-400'>
                @foreach($groupedDishes as $type => $dishes)
                    @foreach($dishes as $dish)
                        <tr class="hidden menuItem_{{ $dish->id }}" data-price="{{ $dish->current_price }}">
                            <td>
                                <p>{{ $dish->full_number }}.</p>
                            </td>
                            <td>
                                <p>{{ $dish->name }}</p>
                            </td>
                            <td>
                                <p>€{{number_format($dish->current_price,2)}}</p>
                                <p class="hidden subAmount"></p>
                            </td>
                            <td>
                                <input type="number" name="{{ $dish->id }}" min="0" value="0">
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </table>
            </form>
            <div id="itemsSelectedTotal" class="p-4 border border-blue-400 w-180">
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
                                <button id="payOrder" class="px-3 py-1 bg-blue-600 text-white rounded">
                                    Afrekenen
                                </button>
                                <button id="clearOrder" class="px-3 py-1 bg-gray-300 text-gray-800 rounded">
                                    Verwijderen
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</x-employeeLayout>