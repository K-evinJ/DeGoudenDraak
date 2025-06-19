<x-employeeLayout>
    <div class="border border-blue-400 rounded-l overflow-y-auto p-4 mt-6">
        <h3 class="text-md font-semibold mb-2">Nieuwe Aanbieding Invoeren</h3>
        <form method="POST" action="">
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
                <input type="number" name="discount_price" step="1" class="border rounded p-2 w-full" min="0" max="100" required>
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
        </form>
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
