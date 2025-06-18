<div class="border border-blue-400 rounded-l overflow-y-auto p-4 mt-6">
    <h3 class="text-md font-semibold mb-2">Nieuwe Aanbieding Invoeren</h3>
    <form method="POST" action="">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Gerecht</label>
            <select name="dish_id" required class="border rounded p-2 w-full">
                @foreach($groupedDishes as $dish)
                    <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Titel van aanbieding</label>
            <input type="text" name="title" class="border rounded p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Aanbiedingsprijs (€)</label>
            <input type="number" name="discount_price" step="0.01" class="border rounded p-2 w-full" required>
        </div>

        <div class="mb-4 flex gap-4">
            <div class="w-1/2">
                <label class="block text-sm font-medium mb-1">Startdatum</label>
                <input type="date" name="start_date" class="border rounded p-2 w-full" required>
            </div>
            <div class="w-1/2">
                <label class="block text-sm font-medium mb-1">Einddatum</label>
                <input type="date" name="end_date" class="border rounded p-2 w-full" required>
            </div>
        </div>

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
