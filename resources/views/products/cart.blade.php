<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Your Cart') }}
        </h2>
    </x-slot>
    <div class="container mx-auto py-8 px-8 max-w-7xl">

        <!-- Display success message if present in session -->
        @if (Session::has('success'))
            <div class="bg-green-500 p-4 rounded-lg mb-6 text-white">{{ Session::get('success') }}</div>
        @endif

        <!-- Check if the cart is not empty -->
        @if ($cart)
            <form id="cartForm" action="{{ route('checkout') }}" method="POST">
                @csrf
                <table class="table-auto w-full mb-6 border border-gray-300 dark:border-gray-700">
                    <thead>
                        <tr class="text-left">
                            <th class="px-4 py-2 text-gray-800 dark:text-white">Product</th>
                            <th class="px-4 py-2 text-gray-800 dark:text-white">Quantity</th>
                            <th class="px-4 py-2 text-gray-800 dark:text-white">Price</th>
                            <th class="px-4 py-2 text-gray-800 dark:text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $id => $item)
                            <tr class="border-b border-gray-300 dark:border-gray-700">
                                <td class="px-4 py-2 flex items-center dark:text-white">
                                    <!-- Display product image and name -->
                                    <img src="{{ filter_var($item['image_url'], FILTER_VALIDATE_URL) ? $item['image_url'] : asset('storage/' . ltrim($item['image_url'], '/')) }}" alt="{{ $item['name'] }}" class="w-12 h-12 object-cover mr-4">
                                    {{ $item['name'] }}
                                </td>
                                <td class="px-4 py-2">
                                    <!-- Input for product quantity -->
                                    <input type="number" name="products[{{ $id }}][quantity]" value="{{ $item['quantity'] }}" min="1" class="quantity-input border rounded-lg w-16 text-center" oninput="calculateTotalPrice()">
                                </td>
                                <td class="px-4 py-2 text-gray-800 dark:text-white">${{ number_format($item['price'], 2) }}</td>
                                <td class="px-4 py-2">
                                    <!-- Button to remove product from cart -->
                                    <button type="button" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded" onclick="removeFromCart({{ $id }})">Remove</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Display total price -->
                <div class="text-right font-bold mb-4 text-gray-800 dark:text-white">
                    Total Price: $<span id="totalPrice">0.00</span>
                    <input type="hidden" name="total_price" id="hiddenTotalPrice" value="0.00">
                </div>

                <!-- Checkout button -->
                <div class="text-right">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Proceed to Checkout</button>
                </div>
            </form>
        @else
            <!-- Message if cart is empty -->
            <p class="text-center text-lg text-gray-800 dark:text-white">Your cart is empty!</p>
            <div class="text-center mt-4">
                <a href="{{ route('shop.index') }}" class=" bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500e px-4 py-2 rounded-lg">Start Shopping</a>
            </div>
        @endif
    </div>

    <script>
        // Function to calculate the total price based on quantities
        const calculateTotalPrice = () => {
            const total = Array.from(document.querySelectorAll('.quantity-input')).reduce((sum, input) => {
                const price = parseFloat(input.closest('tr').querySelector('td:nth-child(3)').innerText.replace('$', ''));
                return sum + price * input.value; // Calculate total
            }, 0);
            // Update total price displayed on the page
            document.getElementById('totalPrice').innerText = total.toFixed(2);
            document.getElementById('hiddenTotalPrice').value = total.toFixed(2); // Hidden input for form submission
        };

        // Function to remove a product from the cart
        const removeFromCart = (id) => {
            fetch(`/cart/remove/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                // Reload the page if removal is successful
                data.success ? location.reload() : alert(data.message); // Show message if not successful
            });
        };

        // Calculate total price on page load
        document.addEventListener('DOMContentLoaded', calculateTotalPrice);
    </script>
</x-app-layout>
