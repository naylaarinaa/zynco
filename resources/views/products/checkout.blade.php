<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Checkout') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8 text-gray-800 dark:text-white">

        @if (!empty($selectedProducts))
            <!-- Input alamat pengiriman -->
            <div class="mb-4">
                <label for="address" class="block mb-2 text-gray-800 dark:text-white">Address:</label>
                <input type="text" id="address" name="address" class="border rounded-lg w-full px-3 py-2 text-black dark:text-white dark:bg-gray-800" required>
            </div>

            <!-- Tabel produk yang dipilih -->
            <table class="table-auto w-full mb-6 text-gray-800 dark:text-white border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-800">
                    <tr class="text-left">
                        <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Product</th>
                        <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Quantity</th>
                        <th class="px-4 py-2 border-b border-gray-300 dark:border-gray-600">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($selectedProducts as $item)
                        <tr class="border-b bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors">
                            <td class="px-4 py-2 flex items-center">
                                <img src="{{ filter_var($item['image_url'], FILTER_VALIDATE_URL) ? $item['image_url'] : asset('storage/' . ltrim($item['image_url'], '/')) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover mr-4">
                                {{ $item['name'] }}
                            </td>
                            <td class="px-4 py-2">{{ $item['quantity'] }}</td>
                            <td class="px-4 py-2">${{ number_format((float)$item['price'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Total harga produk -->
            @php
                $totalPrice = array_reduce($selectedProducts, fn($sum, $item) => $sum + $item['price'] * $item['quantity'], 0);
            @endphp
            <div class="text-right font-bold mb-4">
                Total Price: $<span id="totalPrice">{{ number_format($totalPrice, 2) }}</span>
            </div>

            <!-- Input metode pembayaran dan pengiriman -->
            @foreach (['payment_method' => 'Payment Method', 'shipping_method' => 'Shipping Method'] as $name => $label)
                <div class="mb-4">
                    <label for="{{ $name }}" class="block mb-2 text-gray-800 dark:text-white">{{ $label }}:</label>
                    <select id="{{ $name }}" name="{{ $name }}" class="border rounded-lg w-full px-3 py-2 text-black dark:text-white dark:bg-gray-800" required {{ $name === 'shipping_method' ? 'onchange=updateTotal()' : '' }}>
                        <option value="" disabled selected >Choose {{ strtolower($label) }}</option>
                        @if ($name === 'payment_method')
                            <option value="e-wallet">E-Wallet</option>
                            <option value="debit">Debit Card</option>
                            <option value="credit">Credit Card</option>
                        @else
                            <option value="regular" data-price="5.00">Regular - $5.00</option>
                            <option value="economy" data-price="3.00">Economy - $3.00</option>
                            <option value="instant" data-price="10.00">Instant - $10.00</option>
                        @endif
                    </select>
                </div>
            @endforeach

            <!-- Total harga termasuk biaya pengiriman -->
            <div class="text-right font-bold mb-4">
                Total Price (Including Shipping): $<span id="totalPriceWithShipping">{{ number_format($totalPrice, 2) }}</span>
            </div>

            <!-- Tombol checkout -->
            <div class="text-right">
                <form method="POST" action="{{ route('process.checkout') }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Complete Checkout</button>
                </form>
            </div>
        @else
            <p class="text-center text-lg">No products selected!</p>
        @endif
    </div>

    <script>
        const updateTotal = () => {
            const shippingCost = parseFloat(document.querySelector('#shipping_method option:checked')?.dataset.price || 0);
            const totalPrice = parseFloat(document.getElementById('totalPrice').innerText) + shippingCost;
            document.getElementById('totalPriceWithShipping').innerText = totalPrice.toFixed(2);
        };
        document.addEventListener('DOMContentLoaded', updateTotal);
    </script>
</x-app-layout>
