<x-employeeLayout>
    <div class="max-w-4xl mx-auto p-6 overflow-y-auto h-[calc(100vh-9rem)] p-5 mt-6 border border-blue-400 rounded-l-lg">
        <h1 class="text-2xl font-bold mb-6">Mijn Weekplanning</h1>

        @for ($i = 0; $i < 8; $i++)
            @php
                $date = $startDate->copy()->addDays($i)->toDateString();
                $plans = $tables->get($date) ?? collect();
            @endphp

            <div class="border p-4 mb-3 rounded shadow-sm">
                <strong class="block text-lg mb-2">{{ \Carbon\Carbon::parse($date)->translatedFormat('l d M Y') }}</strong>

                @forelse ($plans as $plan)
                    <div class="flex justify-between">
                        <span>Tafel: {{ $plan->id }}</span>
                        <span class="text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($plan->pivot->start_time)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($plan->pivot->end_time)->format('H:i') }}
                        </span>
                    </div>
                @empty
                    <div class="text-gray-500 italic">Geen planning voor deze dag</div>
                @endforelse
            </div>
        @endfor
    </div>
</x-employeeLayout>
