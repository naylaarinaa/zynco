<x-app-layout>
    <div class="mx-auto px-4 py-6">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-white">Edit Product: {{ $product->name }}</h2>

        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-800 dark:text-white" for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="w-full p-2 border border-gray-600 rounded dark:border-gray-400 dark:bg-gray-800 dark:text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 dark:text-white" for="category">Category:</label>
                <select id="category" name="category" class="w-full border-gray-300 rounded-lg focus:ring focus:border-gray-800 dark:bg-gray-800 dark:text-white" required>
                    <option value="" selected disabled>Select Category</option>
                    <option value="dress" {{ old('category', $product->category) == 'dress' ? 'selected' : '' }}>Dresses</option>
                    <option value="pants" {{ old('category', $product->category) == 'pants' ? 'selected' : '' }}>Pants</option>
                    <option value="jacket" {{ old('category', $product->category) == 'jacket' ? 'selected' : '' }}>Jackets</option>
                    <option value="skirt" {{ old('category', $product->category) == 'skirt' ? 'selected' : '' }}>Skirts</option>
                    <option value="shirt" {{ old('category', $product->category) == 'shirt' ? 'selected' : '' }}>Shirts</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 dark:text-white" for="price">Price:</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="w-full p-2 border border-gray-600 rounded dark:border-gray-400 dark:bg-gray-800 dark:text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 dark:text-white" for="image">Product Image:</label>
                <div class="flex items-center gap-4">
                    <label for="image" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-6 rounded-md cursor-pointer transition-all duration-300 transform hover:scale-105">
                        Choose Image
                    </label>
                    <input type="file" id="image" name="image" class="hidden" onchange="previewImage(event)">
                    <span id="imageName" class="text-gray-800 dark:text-white">No file chosen</span>
                </div>
                <div id="imagePreview" class="mt-4 hidden">
                    <img id="previewImg" src="#" alt="Image Preview" class="w-32 h-32 object-contain">
                </div>
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-6 rounded-md transition-all duration-300 transform hover:scale-105">
                    Update Product
                </button>
            </div>
        </form>
    </div>

    <script>
        // Function to preview the image when a file is chosen
        function previewImage(event) {
            const file = event.target.files[0];
            const imagePreview = document.getElementById('imagePreview');
            const imageName = document.getElementById('imageName');
            const previewImg = document.getElementById('previewImg');
            
            if (file) {
                // Show the image preview section
                imagePreview.classList.remove('hidden');
                // Display image name
                imageName.textContent = file.name;
                // Preview the selected image
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
