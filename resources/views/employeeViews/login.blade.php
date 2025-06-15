<x-employeeLayout>
    <div>
        <form class="flex flex-col place-items-center justify-self-center w-75 border border-gray-400 rounded-2xl py-6 mt-30 text-sm" method="POST" action='{{ route('authenticate') }}'>
            @csrf
            <input class="w-60 mb-1.5 border border-black rounded-xs ps-1" type="number" name="employeeNr" placeholder="Medewerker Nummer" min="1" required>
            <input class="w-60 mb-1.5 border border-black border-rounded rounded-xs ps-1" type="password" name="password" placeholder="Wachtwoord" required>
            <button class="px-10 border border-black rounded bg-gray-200" type="submit">inloggen</button>        
        </form>
    </div>
    @if (session('login_error'))
        <div class='text-red-500 font-bold text-center text-sm p-3'>{{ session('login_error') }}</div>
    @endif
</x-employeeLayout>