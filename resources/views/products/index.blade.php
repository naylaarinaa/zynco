<x-app-layout>
    <head>
        <!-- Add W3.CSS and Font Awesome -->
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
        @vite(['resources/js/app.js', 'resources/css/app.css'])

    <style>
        .swiper-pagination {
            position: relative;
            margin-top: 20px;
        }

        #productModal {
            z-index: 9999;
        }

        /* Bold, large, and attention-grabbing carousel text container */
        .carousel-text-container {
            background: #1a1a1a;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0px 25px 60px rgba(0, 0, 0, 0.5);
            color: white;
            overflow: hidden;
            position: relative;
            text-align: center;
            margin: 4rem 0;
        }

        /* Bold, large, and prominent shop title */
        .shop-title {
            font-size: 3rem;
            font-weight: 650;
            background: linear-gradient(90deg, #ffffff, #e0e0e0);
            -webkit-background-clip: text;
            color: transparent;
            text-shadow: 4px 4px 15px rgba(0, 0, 0, 0.4), -4px -4px 10px rgba(255, 255, 255, 0.3);
            animation: bounceInUp 1.2s ease-out;
        }

        /* Strong bounce-in animation */
        @keyframes bounceInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            60% {
                opacity: 1;
                transform: translateY(-10px);
            }

            80% {
                transform: translateY(5px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>

    <div class="mx-auto px-4">
        <!-- Carousel Container -->
        <div class="swiper-container relative mb-6">
            <div class="swiper-wrapper">
                @foreach ($products as $product)
                    <div class="swiper-slide relative flex justify-center"
                        onclick="openModal('{{ $product->name }}', '{{ asset($product->image_url) }}', '{{ $product->price }}', '{{ $product->category }}', '{{ $product->id }}')">
                        <!-- Full image background -->
                        <div class="w-full h-[500px] bg-cover bg-center"
                            style="background-image: url('{{ asset($product->image_url) }}');">
                            <!-- Overlay for text at the bottom half -->
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 py-4 flex justify-center">
                                <!-- Product Name on bottom of the image -->
                                <h3 class="text-3xl font-bold text-white text-center px-4">{{ $product->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-next text-gray-800 dark:text-gray-300"></div>
            <div class="swiper-button-prev text-gray-800 dark:text-gray-300"></div>
        </div>

        <!-- "Let's Go Shopping!" Section with bold, big, and eye-catching text -->
        <div class="carousel-text-container text-center my-10 p-5">
            <h1 class="shop-title">Discover Your Perfect Finds – Start Shopping!</h1>
        </div>

        <!-- Search and Category Form -->
        <form action="{{ route('search') }}" method="GET" class="flex gap-4 font-semibold">
            <input type="text" name="query" placeholder="Search..." value="{{ $query ?? '' }}"
                class="w-[80%] text-black dark:text-white border rounded-lg bg-transparent focus:outline-none focus:ring focus:border-gray-800">
            <button type="submit"
                class="w-[7%] px-4 py-2 border text-black dark:text-white rounded-lg bg-transparent hover:scale-110 duration-300">Search</button>
            <div class="relative w-[13%]">
                <select name="category" id="categorySelect" onchange="this.form.submit()"
                    class="w-full bg-transparent border rounded-lg px-2 text-black dark:text-white focus:outline-none focus:ring focus:border-gray-800 hover:scale-110 duration-300">
                    <option value="" class="dark:text-black">All Categories</option>
                    <option value="dress" {{ request('category') == 'dress' ? 'selected' : '' }} class="dark:text-black">Dresses</option>
                    <option value="pants" {{ request('category') == 'pants' ? 'selected' : '' }} class="dark:text-black">Pants</option>
                    <option value="jacket" {{ request('category') == 'jacket' ? 'selected' : '' }} class="dark:text-black">Jackets</option>
                    <option value="skirt" {{ request('category') == 'skirt' ? 'selected' : '' }} class="dark:text-black">Skirts</option>
                    <option value="shirt" {{ request('category') == 'shirt' ? 'selected' : '' }} class="dark:text-black">Shirts</option>
                </select>
            </div>
        </form>

        <!-- Image Upload -->
        <form id="imageUploadForm" class="flex items-center justify-center my-4">
            <label for="imageInput" class="text-black dark:text-white font-semibold text-xl mr-4">Find via Picture!</label>
            <input type="file" id="imageInput" accept="image/*" class="hidden" onchange="document.getElementById('processImageBtn').click()">
            <label for="imageInput" class="py-2 px-4 flex border text-black dark:text-white items-center rounded-lg cursor-pointer">
                <i class="fas fa-camera mr-2"></i>
            </label>
            <button type="button" id="processImageBtn"
                class="hidden py-2 px-4 border text-black dark:text-white items-center rounded-lg">Process Image</button>
        </form>

        <!-- Product Table -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            @if(isset($query) && $products->isEmpty())
                <div class="col-span-full text-center">
                    <h2 class="text-black dark:text-white">No products found for '{{ $query }}'.</h2>
                </div>
            @else
                @foreach ($products as $item)
                    <div class="bg-white dark:bg-gray-800 border rounded-lg shadow-lg hover:shadow-2xl hover:scale-105 transition cursor-pointer"
                        onclick="openModal('{{ $item->name }}', '{{ $item->image_url }}', '{{ $item->price }}', '{{ $item->category }}', '{{ $item->id }}')">
                        <div class="product-image w-full h-[200px] overflow-hidden mt-4">
                            <img src="{{ filter_var($item->image_url, FILTER_VALIDATE_URL) ? $item->image_url : asset('storage/' . ltrim($item->image_url, '/')) }}"
                                alt="{{ $item->name }}" class="w-full h-full object-contain">
                        </div>
                        <div class="p-4 text-center">
                            <h2 class="text-lg font-semibold text-black dark:text-white">{{ $item->name }}</h2>
                            <h3 class="text-sm text-black dark:text-white">{{ $item->category }}</h3>
                            <h1 class="text-lg font-bold bg-yellow-400 dark:bg-yellow-500 rounded-lg py-1 mt-2 text-black dark:text-black">${{ $item->price }}</h1>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Modal Popup -->
        <div id="productModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
            <div class="bg-white dark:bg-gray-800 text-black dark:text-white rounded-lg p-6 max-w-md w-full relative">
                <button class="absolute top-3 right-3 text-gray-600 dark:text-gray-400 hover:text-red-500"
                    onclick="closeModal()">&times;</button>
                <div id="modalContent" class="text-center"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/detectObject.js') }}"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                loop: true,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 }
                }
            });
        });

        function openModal(name, imageUrl, price, category, productId) {
            document.getElementById('modalContent').innerHTML = `
                <h2 class="text-2xl font-semibold text-black dark:text-white">${name}</h2>
                <div class="product-image w-[256px] h-[256px] overflow-hidden mx-auto my-4">
                    <img src="${imageUrl}" alt="${name}" class="w-full h-full object-contain">
                </div>
                <h3 class="text-lg font-medium text-black dark:text-white">${category}</h3>
                <h1 class="text-xl font-bold bg-yellow-400 dark:bg-yellow-500 rounded-lg py-2 text-black dark:text-black mb-4">$${price}</h1>
                <div class="mb-6">
                    <label for="quantity" class="text-lg font-medium text-black dark:text-white">Quantity:</label>
                    <input type="number" id="quantity" value="1" min="1" class="border rounded-lg w-16 text-center dark:text-black">
                </div>
                <button onclick="addToCart(${productId}, document.getElementById('quantity').value);" class="w3-button w3-green w3-round-large w3-margin-bottom">
                    <i class="fa fa-shopping-cart"></i> Add to Cart
                </button>
            `;
            document.getElementById('productModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('productModal').classList.add('hidden');
        }

        function addToCart(productId) {
            const quantity = document.getElementById('quantity').value;
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/cart/add/${productId}`;
            form.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="quantity" value="${quantity}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</x-app-layout>
