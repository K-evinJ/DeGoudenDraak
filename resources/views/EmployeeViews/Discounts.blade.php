<x-employeeLayout>
    <div class="flex justify-between w-screen h-[calc(100vh-7rem)]">
        <div class="border border-blue-400 rounded-l overflow-y-auto p-4 m-6 me-2 w-[50%] h-[95%]">
            <h3 class="text-md font-semibold mb-4">Actieve Aanbiedingen</h3>

            @forelse($discounts as $discount)
                <div class="border border-gray-300 rounded p-3 mb-3 shadow-sm">
                    <p class="text-sm font-medium">{{ $discount->name }}</p>
                    <p class="text-xs text-gray-600 mb-1">
                        Van {{ \Carbon\Carbon::parse($discount->start_date)->format('d-m-Y') }}
                        tot {{ \Carbon\Carbon::parse($discount->end_date)->format('d-m-Y') }}
                    </p>
                    <p class="text-sm text-green-700 font-semibold">
                        {{ $discount->discount_percentage }}% korting
                    </p>
                </div>
            @empty
                <p class="text-sm text-gray-500">Er zijn momenteel geen actieve aanbiedingen.</p>
            @endforelse
        </div>
        <div class="border border-blue-400 rounded-l overflow-y-auto p-4 m-6 mb-2 w-[50%] h-fit">
            <h3 class="text-md font-semibold mb-2">Nieuwe Aanbieding Invoeren</h3>
            <form method="POST" action="{{ route('storeDiscount') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Gerecht</label>
                    <select name="dish_id" required class="border rounded p-2 w-full">
                        @foreach($groupedDishes as $type => $dishes)
                            <optgroup label="{{ ($type) }}">
                            @foreach($dishes as $dish)
                                <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Aanbiedingspercentage</label>
                    <input type="number" name="discount_percentage" step="1" class="border rounded p-2 w-full" min="0" max="100" required>
                </div>

                <div class="mb-4 flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-sm font-medium mb-1">Startdatum</label>
                        <input type="date" name="startDate" id="startDate" class="border rounded p-2 w-full" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-medium mb-1">Einddatum</label>
                        <input type="date" name="endDate" id="endDate" class="border rounded p-2 w-full" required>
                    </div>
                </div>
                <p class="text-red-400 hidden" id="dateError">De einddatum moet na de begindatum liggen.</p>

                <button type="submit" class="px-4 py-1 bg-green-200 border border-black rounded hover:bg-green-300">
                    Toevoegen
                </button>

                @error('dish_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('discount_price')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('startDate')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                @error('endDate')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </form>
        </div>
    </div>
    @if(session('message'))
        <div id="successModal" class="fixed inset-0 z-50">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="relative z-10 mx-auto mt-70 w-120 bg-white p-8 shadow-lg">
                <div class="flex justify-between items-start">
                    <h2 class="text-sm">{{ session('message') }}</h2>
                    <button onclick="document.getElementById('successModal').classList.add('hidden')" class="text-gray-600 text-2xl hover:text-black">&times;</button>
                </div>
            </div>
        </div>
    @endif

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

    const modal = document.getElementById('successModal');

    if (modal) {
        const closeModal = () => modal.classList.add('hidden');

        modal.addEventListener('click', (event) => {
                closeModal();
        });
    }
</script>
