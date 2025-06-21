<x-employeeLayout>
    <div id="app" class="flex p-5 gap-x-3 h-[90vh]">
        <main class="flex flex-col gap-y-5 w-[60vw]">
            <section class="flex gap-x-3 border border-blue-500 rounded-lg p-5">
                <label for="search" class="flex flex-col">
                    Zoeken
                    <input v-model="search" type="text" name="search" id="search"
                        class="px-3 py-2 border rounded-lg">
                </label>
                <label for="category" class="flex flex-col">
                    Categorie filteren
                    <select v-model="category" name="category" id="category"
                        class="px-3 py-2 h-full border rounded-lg">
                        <option value="">Alle Categorieën</option>
                        <option v-for="(dishes, groupName) in groupedDishes" :key="groupName"
                            :value="groupName">@{{ groupName }}</option>
                    </select>
                </label>
            </section>
            <section
                class="flex flex-col content-between overflow-y-scroll border border-blue-500 rounded-lg p-5 h-full">
                <div v-for="(dishes, groupName) in filteredDishes" :key="groupName"
                    class="font-semibold text-lg justify-self-center">
                    <h2>@{{ groupName.toUpperCase() }}</h2>
                    <div v-for="dish in dishes" :key="dish.id"
                        class="flex justify-between items-center my-1 text-sm w-full font-normal">
                        <p>@{{ dish.number }}@{{ dish.menu_addition }}. @{{ dish.name }}</p>
                        <div class="flex">
                            <p>€ @{{ dish.price.replace('.', ',') }}</p>
                            <button @click="addToOrder(dish.id)"
                                class="addMenuItem px-2 border border-black rounded bg-gray-200 hover:bg-gray-300 ms-2">toevoegen</button>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <div class="border border-blue-500"></div>
        <aside class="flex flex-col gap-y-5 w-[40vw]">
            <section
                class="flex flex-col content-between border border-blue-500 rounded-lg p-5 h-9/10 overflow-y-scroll">
                <h1 class="text-center font-semibold text-lg my-3">Bestelling</h1>
                <div v-for="dish in order" :key="dish.id"
                    class="flex justify-between items-center my-1 text-sm w-full font-normal">
                    <p>@{{ dish.number }}@{{ dish.menu_addition }}. @{{ dish.name }}</p>
                    <div class="flex items-center">
                        <p>€ @{{ dish.price.replace('.', ',') }}</p>
                        <input @change="checkCount(dish.count)" type="number" min="0" v-model="dish.count"
                            class="ms-2 border border-gray-400 rounded px-2 py-1 w-20">
                    </div>
                </div>
            </section>
            <section class="flex items-center border border-blue-500 rounded-lg p-5 h-1/10 gap-x-3">
                <div class="flex justify-between w-full me-5">
                    <span class="font-bold text-xl">Totaal:</span>
                    <span class="font-bold text-xl">€ @{{ totalPrice }}</span>
                </div>
                <form action="{{ route('orderCashregister') }}" method="POST">
                    @csrf
                    <input type="hidden" name="dishes" id="dishes" :value="JSON.stringify(flatOrder)">
                    <button type="submit"
                        class="px-3 my-1 border border-black rounded bg-gray-200 hover:bg-gray-300 text-sm">
                        Afrekenen
                    </button>
                </form>
                <button @click="clearOrder" type="button"
                    class="px-3 my-1 border border-black rounded bg-gray-200 hover:bg-gray-300 text-sm">
                    Verwijderen
                </button>
            </section>
        </aside>
    </div>
    <div id="successModal" class="fixed inset-0 z-50 hidden" onclick="closeModal()">
        <!-- Background overlay -->
        <div class="absolute inset-0 bg-black opacity-40"></div>

        <!-- Modal content -->
        <div class="relative z-10 mx-auto mt-70 w-120 bg-white p-8 shadow-lg">
            <div class="flex justify-between items-start">
                <h2 class="text-sm">{{ session('order_message') }}</h2>
                <button onclick="closeModal()"
                    class="text-gray-600 text-2xl leading-none hover:text-black">&times;</button>
            </div>
        </div>
    </div>
</x-employeeLayout>

<script type="module">
    const {
        createApp
    } = Vue;

    const app = createApp({
        data() {
            return {
                groupedDishes: [],
                totalPrice: '0,00',
                order: [],
                search: '',
                category: '',
            }
        },
        methods: {
            async getDishes() {
                let url = '{{ route('api.dishes') }}';
                await axios.get(url).then(response => {
                    this.groupedDishes = response.data.groupedDishes;
                });
            },
            addToOrder(dishId) {
                for (const group in this.groupedDishes) {
                    const dish = this.groupedDishes[group].find(d => d.id === dishId);
                    if (dish) {
                        const existing = this.order.find(item => item.id === dishId);
                        if (existing) {
                            existing.count++;
                        } else {
                            this.order.push({
                                ...dish,
                                count: 1
                            });
                        }

                        this.updateTotalPrice();
                        break;
                    }
                }
            },
            updateTotalPrice() {
                let total = 0;
                this.order.forEach(dish => {
                    total += Number(dish.price * dish.count);
                });
                this.totalPrice = parseFloat(total).toFixed(2).replace('.', ',');
            },
            checkCount(count) {
                if (count < 1) {
                    this.order = this.order.filter(dish => dish.count > 0);
                }
                this.updateTotalPrice();
            },
            clearOrder() {
                this.order = [];
                this.updateTotalPrice();
            }
        },
        computed: {
            filteredDishes() {
                const search = this.search.toLowerCase();
                const filtered = {};

                if (this.category) {
                    const dishes = this.groupedDishes[this.category] || [];
                    const matched = dishes.filter(dish =>
                        dish.name.toLowerCase().includes(search) ||
                        dish.number.toString().includes(search)
                    );
                    if (matched.length > 0) {
                        filtered[this.category] = matched;
                    }
                } else {
                    for (const group in this.groupedDishes) {
                        const dishes = this.groupedDishes[group].filter(dish =>
                            dish.name.toLowerCase().includes(search) ||
                            dish.number.toString().includes(search))

                        if (dishes.length) {
                            filtered[group] = dishes;
                        }
                    }
                }

                return filtered;
            },
            flatOrder() {
                const flatOrder = {};
                for (const dish of this.order) {
                    if (dish.count > 0) {
                        flatOrder[dish.id] = dish.count;
                    }
                }
                return flatOrder;
            }
        },
        mounted() {
            this.getDishes();
        }
    });

    app.mount('#app');
</script>

@if (session('download_receipt_order_id'))
    <script>
        if (confirm('Wilt u de rekening downloaden?')) {
            // Open the PDF download in a new tab
            window.open("{{ route('receipt.download', ['order' => session('download_receipt_order_id')]) }}", '_blank');
        }
    </script>
@endif

@if (session('order_message'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.classList.remove('hidden');
            }
        });

        function closeModal() {
            const modal = document.getElementById('successModal');
            if (modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
@endif
