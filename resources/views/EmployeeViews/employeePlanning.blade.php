<x-employeeLayout>
    <div class="w-[90%] mx-auto p-6 h-[calc(100vh-7rem)] overflow-y-hidden">
        <div class="flex space-x-8 h-[100%]">
            <div class="w-1/2 overflow-auto h-[100%] border border-blue-400 p-3 rounded-l-lg">
                @if ($table)
                    <h1 class="text-2xl font-bold mb-6">Weekplanning Tafel {{ $table->id }}</h1>
                @endif

                    {{-- Table Selection --}}
                <form method="GET" action="{{ route('admin.planning') }}" class="mb-6">
                    <label for="table_id" class="block font-semibold mb-1">Selecteer Tafel:</label>
                    <select name="table_id" id="table_id" onchange="this.form.submit()" class="border rounded p-2">
                        @foreach ($tables as $t)
                            <option value="{{ $t->id }}" {{ $t->id == $table->id ? 'selected' : '' }}>
                                Tafel {{ $t->id }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <h2 class="text-xl font-semibold mb-4">Weekplanning</h2>

                @for ($i = 0; $i < 8; $i++)
                @php
                    $date = $startDate->copy()->addDays($i)->toDateString();
                    $plans = $table->employees->filter(fn($emp) => $emp->pivot->date === $date);
                @endphp

                <div class="border p-4 mb-3 rounded shadow-sm">
                    <strong class="block text-lg mb-2">{{ \Carbon\Carbon::parse($date)->translatedFormat('l d M Y') }}</strong>
                    @forelse ($plans as $plan)
                        <div class="flex justify-between">
                            <span>{{ $plan->id }}</span>
                            <span class="text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($plan->pivot->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($plan->pivot->end_time)->format('H:i') }}
                            </span>
                        </div>
                    @empty
                        <div class="text-gray-500 italic">Geen planning</div>
                    @endforelse
                </div>
                @endfor
            </div>

            <div class="w-1/2 h-[95%] overflow-y-auto">
                <div class="border border-blue-400 rounded-tl-lg">
                    <h2 class="text-xl font-semibold mb-4">Voeg Planning Toe</h2>
                    <form method="POST" action="" class="space-y-4 bg-gray-50 p-6 rounded shadow-sm">
                        @csrf

                        <input type="hidden" name="table_id" value="{{ $table->id }}">

                        <div>
                            <label class="block font-semibold mb-1" for="date">Datum</label>
                            <input type="date" name="date" class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block font-semibold mb-1" for="start_time">Starttijd</label>
                            <input type="time" name="start_time" class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block font-semibold mb-1" for="end_time">Eindtijd</label>
                            <input type="time" name="end_time" class="w-full border rounded p-2" required>
                        </div>

                        <div>
                            <label class="block font-semibold mb-1" for="employee_id">Medewerker</label>
                            <select name="employee_id" class="w-full border rounded p-2" required>
                                <option value="">-- Selecteer medewerker --</option>
                                @foreach ($employees as $emp)
                                    <option value="{{ $emp->id }}">{{ $emp->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Planning Opslaan
                        </button>
                    </form>
                </div>
                <div class="p-3 mb-17 border border-blue-400 rounded-bl-lg">
                    <h2 class="text-lg">werknemer aanmaken</h2>
                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('employee.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="block font-medium mb-1">Wachtwoord</label>
                            <input type="password" name="password" id="password" required
                                class="w-full border border-gray-300 p-2 rounded">
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Werknemer Aanmaken
                        </button>
                    </form>
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
                    <h2 class="text-sm">{{ session('message') }}</h2>
                    <button onclick="closeModal()" class="text-gray-600 text-2xl leading-none hover:text-black">&times;</button>
                </div>
            </div>
        </div>
    </div>
</x-employeeLayout>
@if(session('message'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            showModal();
        });
    </script>
@endif
