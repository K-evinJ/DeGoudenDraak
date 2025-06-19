<x-employeeLayout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Weekplanning Tafel {{ $table->id }}</h1>

        @if(session('message'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        {{-- Table Selection --}}
        <form method="GET" action="{{ route('employee.planning') }}" class="mb-6">
            <label for="table_id" class="block font-semibold mb-1">Selecteer Tafel:</label>
            <select name="table_id" id="table_id" onchange="this.form.submit()" class="border rounded p-2">
                @foreach ($tables as $t)
                    <option value="{{ $t->id }}" {{ $t->id == $table->id ? 'selected' : '' }}>
                        Tafel {{ $t->id }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="flex space-x-8">
            {{-- LEFT: Weekly Planning --}}
            <div class="w-1/2">
                <h2 class="text-xl font-semibold mb-4">Weekplanning</h2>

                @for ($i = 0; $i < 7; $i++)
                    @php
                        $date = $startOfWeek->copy()->addDays($i)->toDateString();
                        $plans = $table->employees->filter(fn($emp) => $emp->pivot->date === $date);
                    @endphp

                    <div class="border p-4 mb-3 rounded shadow-sm">
                        <strong class="block text-lg mb-2">{{ \Carbon\Carbon::parse($date)->translatedFormat('l d M Y') }}</strong>
                        @forelse ($plans as $plan)
                            <div class="flex justify-between">
                                <span>{{ $plan->name }}</span>
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

            {{-- RIGHT: Planning Form --}}
            <div class="w-1/2">
                <h2 class="text-xl font-semibold mb-4">Voeg Planning Toe</h2>

                <form method="POST" action="{{ route('employee.planning.store') }}" class="space-y-4 bg-gray-50 p-6 rounded shadow-sm">
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
                                <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Planning Opslaan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-employeeLayout>
