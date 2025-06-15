<x-employeeLayout>
    <div class="flex h-26 mt-7 mb-2">
        <div class="w-140 mx-4 p-5 rounded border border-blue-400 self-center">
            <form class="flex flex-row" action="{{ route('salesForTimeframe') }}">
                <div class="flex flex-col h-16">
                    <div class="flex flex-row m-1">
                        <label class="w-25">Begin datum:</label>
                        <input name="BeginDate" class="w-27 border border-gray-400 text-sm tracking-wider" id='startDate' type="date" max="Date.now()">
                    </div>
                    <div class="flex flex-row m-1">
                        <label class="w-25">Eind datum:</label>
                        <input name="EndDate" class="w-27 border border-gray-400 text-sm tracking-wider" id='endDate' type="date">
                    </div>
                    <p class="text-red-400 hidden" id="dateError">De einddatum moet na de begindatum liggen.</p>
                </div>
                <button type="submit" class="font-sans text-lg px-3 ms-3 my-1 bg-blue-100 border border-blue-500 rounded-xl text-blue-600 font-bold">Maak Overzicht</button>
            </form>
        </div>
        <div class="w-328 rounded border border-blue-400 flex flex-col justify-center items-center p-4">
            <div class="flex justify-between w-full text-3xl font-semibold space-x-8">
                <div class="flex-1 text-center flex justify-around">
                    <p>Omzet:</p>
                    <p>€{{ $total }}</p>
                </div>
                <div class="flex-1 text-center flex justify-around">
                    <span>BTW:</span>
                    <p>€{{ $vat }}</p>
                </div>
                <div class="flex-1 text-center flex justify-around">
                    <span>excl. BTW:</span>
                    <p>€{{ $total - $vat }}</p>
                </div>
            </div>
        </div>
    </div>
    <hr class="mx-2 h-0.5 bg-blue-600 border-0">
    <div class="overflow-y-auto h-115 w-472 p-4 border border-blue-400 rounded-l-lg mx-auto mt-2">
        <table class="w-2/3 mx-auto border-separate border-spacing-0 text-sm">
            <thead>
                <tr class="text-left font-bold">
                    <th class="border-b-2 border-blue-500 pr-2 pb-1 text-center">Datum</th>
                    <th class="border-b-2 border-blue-500 border-l-2 border-blue-500 px-4 pb-1 text-center">Bestelling</th>
                    <th class="border-b-2 border-blue-500 border-l-2 border-blue-500 px-4 pb-1 text-center">Gerecht</th>
                    <th class="border-b-2 border-blue-500 border-l-2 border-blue-500 px-4 pb-1 text-center">Prijs</th>
                    <th class="border-b-2 border-blue-500 border-l-2 border-blue-500 px-4 pb-1 text-center">Aantal</th>
                    <th class="border-b-2 border-blue-500 border-l-2 border-blue-500 px-4 pb-1 text-center">Subtotaal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @foreach ($order->dishes as $dish)
                        <tr class="text-sm text-center">
                            <td class="py-1 w-20">{{ \Carbon\Carbon::parse($order->moment)->format('d-m-Y') }}</td>
                            <td class="py-1 w-10">{{ $order->id }}</td>
                            <td class="py-1 w-100 text-start ps-1">{{ $dish->name }}</td>
                            <td class="py-1 w-25">€{{ number_format($dish->pivot->original_dishprice, 2) }}</td>
                            <td class="py-1 w-20">{{ $dish->pivot->amount }}</td>
                            <td class="py-1 w-35">€{{ number_format($dish->pivot->amount * $dish->pivot->original_dishprice, 2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
    const start = document.getElementById('startDate');
    const end = document.getElementById('endDate');
    const error = document.getElementById('dateError');

    function validateDates() {
        if (start.value && end.value && start.value > end.value) {
            error.classList.remove('hidden');
        } else {
            error.classList.add('hidden');
        }
    }

    start.addEventListener('input', validateDates);
    end.addEventListener('input', validateDates);
});
</script>

@if(session('order_message'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showModal();
        });
    </script>
@endif