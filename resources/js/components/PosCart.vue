<template>
    <div class="grid grid-cols-2 gap-4 p-6"> 
    <!-- Product List -->
        <div>
            <h2 class="text-xl font-bold mb-4">Producten</h2>
            <div v-for="product in products" :key="product.id" class="flex justify-between items-center border p-2 mb-2 rounded">
                <span>{{ product.name }} (€{{ product.price.toFixed(2) }})</span>
                <button class="bg-green-500 text-white px-3 py-1 rounded" @click="addToCart(product)">
                    Toevoegen
                </button>
            </div>
        </div>

        <!-- Cart -->
        <div class="border p-4 rounded shadow">
            <h2 class="text-xl font-bold mb-4">Winkelwagen</h2>
            <div v-for="(item, index) in cart" :key="item.id" class="flex justify-between items-center mb-2">
                <span>{{ item.name }} (€{{ item.price.toFixed(2) }})</span>
                <div class="flex items-center space-x-2">
                    <input type="number" min="0" v-model.number="item.quantity" @change="updateQuantity(index, item.quantity)" class="w-16 text-center border rounded">
                    <button @click="removeItem(index)" class="text-red-500">✕</button>
                </div>
            </div>

            <p class="mt-4 font-semibold">Totaal: €{{ total.toFixed(2) }}</p>

            <div class="mt-3 space-x-2">
                <button class="bg-red-500 text-white px-4 py-1 rounded" @click="clearCart">Reset</button>
                <button class="bg-blue-500 text-white px-4 py-1 rounded" @click="checkout">Afrekenen</button>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, computed } from 'vue'
    import axios from 'axios'

    const props = defineProps({
        products: Array
    })

    const cart = ref([])

    const addToCart = (product) => {
        const existing = cart.value.find(i => i.id === product.id)
        if (existing) {
            existing.quantity++
        } else {
            cart.value.push({ ...product, quantity: 1 })
        }
    }

    const updateQuantity = (index, quantity) => {
        if (quantity <= 0) cart.value.splice(index, 1)
        else cart.value[index].quantity = quantity
    }

    const removeItem = (index) => {
        cart.value.splice(index, 1)
    }

    const clearCart = () => {
        cart.value = []
    }

    const total = computed(() => {
    return cart.value.reduce((sum, item) => sum + item.price * item.quantity, 0)
    })

    const checkout = () => {
        axios.post('/employee/checkout', { cart: cart.value })
        .then(res => {
            alert('Betaling geslaagd!')
            clearCart()
        })
        .catch(err => {
            alert('Fout bij afrekenen.')
        })
    }
</script>
