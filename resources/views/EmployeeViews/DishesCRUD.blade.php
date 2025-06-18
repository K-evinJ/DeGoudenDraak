<x-employeeLayout>
    <div class="flex h-[calc(100vh-7rem)]">
        <div class="overflow-y-auto w-[60%] m-5 me-0 border border-blue-400 rounded-l-lg p-5">
            @foreach($groupedDishes as $type => $dishes)
                <h2 class="font-semibold text-lg">{{ strtoupper($type) }}</h2>
                @foreach($dishes as $dish)
                    <div class="flex justify-between items-center my-1 text-sm">
                        <div class="flex w-8/10">
                            <p class="w-2/10">{{ $dish->full_number }}.</p>
                            <p class="w-8/10">{{ $dish->name }}</p>
                        </div>
                        <p>€{{ $dish->current_price }}</p>
                        <button class="selectDish px-2 border border-black rounded bg-gray-200 hover:bg-gray-300"
                                data-id="{{ $dish->id }}"
                                data-name="{{ $dish->name }}"
                                data-description="{{ $dish->description }}"
                                data-price="{{ $dish->price }}"
                                data-visible="{{ $dish->visible }}">
                            Bewerken
                        </button>
                    </div>
                @endforeach
            @endforeach
        </div>

        <div class="w-full mt-5 me-5">
            <div class="border border-blue-400 rounded-l overflow-y-auto p-4">
                <form method="POST" action="{{ route('admin.storeOrUpdate') }}">
                    @csrf
                    <input type="hidden" name="dish_id" id="dish_id">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Naam</label>
                        <input type="text" name="name" id="dish_name" class="border w-full rounded p-2" maxlength="50" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Beschrijving</label>
                        <input type="text" name="description" id="dish_description" class="border w-full rounded p-2" maxlength="300">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Gerechttype</label>
                        <select name="dish_type" id="dish_type" required class="border rounded p-2 w-full">
                            @foreach($dishTypes as $type)
                                <option value="{{ $type->type }}">{{ ucfirst($type->type) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Prijs (€)</label>
                        <input type="number" name="price" id="dish_price" step="0.01" class="border w-full rounded p-2" min="0" required>
                    </div>
                    <div class="mb-4 flex items-center space-x-2">
                        <input type="checkbox" name="visible" id="is_visible" class="rounded" checked='true'>
                        <label for="visible" class="text-sm">Zichtbaar voor klanten</label>
                    </div>

                    <div class="flex justify-between mt-6">
                        <button type="button" id="resetForm"
                                class="px-4 py-1 border border-black rounded bg-gray-200 hover:bg-gray-300">
                            Reset
                        </button>
                        <button type="submit"
                                class="px-4 py-1 border border-black rounded bg-green-200 hover:bg-green-300">
                            <span id="submit_button_label">Aanmaken</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="border border-blue-400 rounded-l overflow-y-auto p-4">
                <h3 class="text-md font-semibold mb-2">Nieuw Gerechttype Toevoegen</h3>
                <form method="POST" action="{{ route('admin.storeDishType') }}">
                    @csrf
                    <div class="flex items-center gap-2">
                        <input type="text" name="type" placeholder="Bijv. Nagerecht"
                            required class="border rounded p-2 w-full">
                        <button type="submit" class="px-3 py-1 bg-blue-200 border border-black rounded hover:bg-blue-300">
                            Toevoegen
                        </button>
                    </div>
                    
                    @error('type')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </form>
            </div>
        </div>
    </div>

    @if(session('dish_message'))
        <div id="successModal" class="fixed inset-0 z-50">
            <div class="absolute inset-0 bg-black opacity-40"></div>
            <div class="relative z-10 mx-auto mt-70 w-120 bg-white p-8 shadow-lg">
                <div class="flex justify-between items-start">
                    <h2 class="text-sm">{{ session('dish_message') }}</h2>
                    <button onclick="document.getElementById('successModal').classList.add('hidden')" class="text-gray-600 text-2xl hover:text-black">&times;</button>
                </div>
            </div>
        </div>
    @endif

    <script>
        document.querySelectorAll('.selectDish').forEach(button => {
            button.addEventListener('click', () => {
                document.getElementById('dish_id').value = button.dataset.id;
                document.getElementById('dish_name').value = button.dataset.name;
                document.getElementById('dish_description').value = button.dataset.description;
                document.getElementById('dish_price').value = button.dataset.price;
                if(button.dataset.visible == 1){
                    document.getElementById('is_visible').checked = 'on';
                }
                else {
                    document.getElementById('is_visible').checked = '';
                }
                document.getElementById('submit_button_label').innerText = 'Bijwerken';
            });
        });

        document.getElementById('resetForm').addEventListener('click', () => {
            document.getElementById('dish_id').value = '';
            document.getElementById('dish_name').value = '';
            document.getElementById('dish_price').value = '';
            document.getElementById('is_visible').checked = true;
            document.getElementById('submit_button_label').innerText = 'Aanmaken';
        });

        const modal = document.getElementById('successModal');

        if (modal) {
            const closeModal = () => modal.classList.add('hidden');

            modal.addEventListener('click', (event) => {
                    closeModal();
            });
        }
    </script>
</x-employeeLayout>
