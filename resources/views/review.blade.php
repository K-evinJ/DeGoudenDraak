<x-layout>
    <main class="flex flex-col w-[40vw] font-[chinese]">
        <form action="{{ route('review.store') }}" method="POST" class="flex flex-col gap-y-2">
            @csrf
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <select name="rating" id="rating" required class="shadow-sm rounded p-2 bg-white">
                <option selected disabled>Aantal sterren</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <textarea name="comment" id="comment" cols="30" rows="5" placeholder="Deel je mening..."
                class="shadow-sm rounded p-2 bg-white" required></textarea>
            <button type="submit"
                class="bg-[url(/public/images/menu_bg_gradient.png)] border-r-1 border-b-1 
                border-white px-7 h-6 flex items-center justify-center cursor-pointer text-white text-[20px] transition">Publiceer</button>
        </form>
        <section class="flex flex-col mt-3">
            <h1 class="text-[yellow] text-[20px]">Alle reviews:</h1>
            @foreach ($reviews as $review)
                <div class="border p-4 rounded mb-2 bg-white shadow">
                    <div class="flex justify-between">
                        <p class="font-semibold">{{ $review->rating }} sterren</p>
                        <p class="font-semibold">{{ $review->created_at->format('d-m-Y') }}</p>
                    </div>
                    <p>{{ $review->comment }}</p>
                </div>
            @endforeach
            @if ($reviews->isEmpty())
                <p class="text-[yellow] mt-2">Nog geen reviews beschikbaar.</p>
            @endif
        </section>
    </main>
    <div class="w-[50px]"></div>
</x-layout>
