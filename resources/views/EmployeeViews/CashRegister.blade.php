{{-- <x-employeeLayout> --}}
    <div class="grid grid-cols-2 gap-6 p-6">
        <!-- Product list -->
        <div>
            <h2 class="text-xl font-bold mb-4">Producten</h2>
            @foreach ($products as $product)
                <div class="flex justify-between items-center border p-2 rounded mb-2">
                    <span>{{ $product->name }} (€{{ number_format($product->price, 2) }})</span>
                    <button
                        class="bg-green-500 text-white px-3 py-1 rounded"
                        @click="addToCart({ id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price }} })">
                        Voeg toe
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Cart -->
        <div x-data="cartHandler()" class="border p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Winkelwagen</h2>

            <template x-for="(item, index) in cart" :key="item.id">
                <div class="flex justify-between items-center mb-2">
                    <span x-text="`${item.name} (€${item.price.toFixed(2)})`"></span>
                    <div class="flex items-center space-x-2">
                        <input type="number" class="w-16 border rounded text-center" min="0"
                            x-model.number="item.quantity"
                            @change="updateQuantity(index, item.quantity)">
                        <button class="text-red-500" @click="removeItem(index)">✕</button>
                    </div>
                </div>
            </template>

            <p class="mt-4 font-semibold">Totaal: €<span x-text="total.toFixed(2)"></span></p>

            <div class="mt-3 space-x-2">
                <button class="bg-red-500 text-white px-4 py-1 rounded" @click="clearCart()">Reset</button>
                <button class="bg-blue-500 text-white px-4 py-1 rounded" @click="checkout()">Afrekenen</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        function cartHandler() {
            return {
                cart: [],
                get total() {
                    return this.cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
                },
                addToCart(product) {
                    let found = this.cart.find(i => i.id === product.id);
                    if (found) {
                        found.quantity++;
                    } else {
                        this.cart.push({ ...product, quantity: 1 });
                    }
                },
                updateQuantity(index, qty) {
                    if (qty <= 0) {
                        this.cart.splice(index, 1);
                    } else {
                        this.cart[index].quantity = qty;
                    }
                },
                removeItem(index) {
                    this.cart.splice(index, 1);
                },
                clearCart() {
                    this.cart = [];
                },
                checkout() {
                    fetch('/employee/checkout', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: JSON.stringify({ cart: this.cart }),
                    }).then(res => res.json())
                        .then(data => {
                        if (data.success) {
                            alert('Betaling succesvol!');
                            this.clearCart();
                        } else {
                            alert('Fout bij afrekenen!');
                        }
                    });
                }
            }
        }
    </script>
{{-- </x-employeeLayout> --}}
