<x-employeeLayout>
    <div class="flex p-5 gap-x-3 h-[90vh]">
        <main class="flex flex-col gap-y-5 w-[60vw]">
            <section class="flex gap-x-3 border border-blue-500 rounded-lg p-5">
                <label for="search" class="flex flex-col">
                    Zoeken
                    <input type="text" name="search" id="search" class="px-3 py-2 border rounded-lg">
                </label>
                <label for="category" class="flex flex-col">
                    Categorie filteren
                    <select name="category" id="category" class="px-3 py-2 h-full border rounded-lg">
                        <option value="all">Alle Categorieën</option>
                    </select>
                </label>
            </section>
            <section class="flex flex-col content-between overflow-y-scroll border border-blue-500 rounded-lg p-5 h-full">

            </section>
        </main>
        <div class="border border-blue-500"></div>
        <aside class="flex flex-col gap-y-5 w-[40vw]">
            <section class="flex flex-col content-between border border-blue-500 rounded-lg p-5 h-9/10">

            </section>
            <section class="flex justify-between border border-blue-500 rounded-lg p-5 h-1/10">

            </section>
        </aside>
    </div>
</x-employeeLayout>