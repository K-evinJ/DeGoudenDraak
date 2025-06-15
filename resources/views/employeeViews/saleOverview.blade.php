<x-employeeLayout>
    <div class="flex h-26 mt-7 mb-2">
        <div class="w-140 mx-4 p-5 rounded border border-blue-400 self-center">
            <form class="flex flex-row" action="">
                <div class="flex flex-col h-16">
                    <div class="flex flex-row m-1">
                        <label class="w-25">Begin datum:</label>
                        <input class="w-27 border border-gray-400 text-sm tracking-wider" id='startDate' type="date" max="Date.now()">
                    </div>
                    <div class="flex flex-row m-1">
                        <label class="w-25">Eind datum:</label>
                        <input class="w-27 border border-gray-400 text-sm tracking-wider" id='endDate' type="date">
                    </div>
                    <p class="text-red-400 hidden" id="dateError">De einddatum moet na de begindatum liggen.</p>
                </div>
                <button class="font-sans text-lg px-3 ms-3 my-1 bg-blue-100 border border-blue-500 rounded-xl text-blue-600 font-bold">Maak Overzicht</button>
            </form>
        </div>
        <div class="w-328 rounded border border-blue-400">

        </div>
    </div>
    <div class="h-100 border border-blue-400">

    </div>
</x-employeeLayout>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const start = document.getElementById('startDate');
    const end = document.getElementById('endDate');
    const error = document.getElementById('dateError');

    function validateDates() {
        if (start.value && end.value && start.value >= end.value) {
            error.classList.remove('hidden');
        } else {
            error.classList.add('hidden');
        }
    }

    start.addEventListener('input', validateDates);
    end.addEventListener('input', validateDates);
});
</script>