<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Add New Item') }}
        </h2>
    </x-slot>

    <form method="POST" action="{{ route('shop.add') }}" enctype="multipart/form-data">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="category" :value="__('Category')" />
            <select id="category" name="category" class="block mt-1 w-full border-gray-300 rounded-lg focus:ring focus:border-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-white" required>
                <option value="" disabled selected>Select Category</option>
                @foreach(['dress' => 'Dresses', 'pants' => 'Pants', 'jacket' => 'Jackets', 'skirt' => 'Skirts', 'shirt' => 'Shirts'] as $value => $label)
                    <option value="{{ $value }}" {{ (old('category') == $value) ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="image" :value="__('Upload Photo')" />
            
            <!-- Custom styled file input button similar to 'Add New Item' button -->
            <div class="relative">
                <input type="file" id="image" class="hidden" name="image" required onchange="previewImage(event)" />
                <button type="button" class="inline-flex items-center justify-center px-6 py-2 mt-2 bg-gray-600 text-white font-semibold rounded-lg shadow-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500" onclick="document.getElementById('image').click()">
                    <i class="fas fa-camera mr-2"></i> Choose File
                </button>
            </div>
            
            <x-input-error :messages="$errors->get('image')" class="mt-2" />

            <!-- Image Preview -->
            <div class="mt-4" id="imagePreviewContainer">
                <img id="imagePreview" class="hidden w-full h-64 object-contain rounded-lg shadow-lg" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" class="block mt-1 w-full" type="text" name="price" required autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button class="ms-4">{{ __('Add New Item') }}</x-primary-button>
        </div>
    </form>

    <script>
        // Image preview function
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const image = document.getElementById('imagePreview');
                image.src = e.target.result;
                image.classList.remove('hidden'); // Show the image preview
            };

            if (file) {
                reader.readAsDataURL(file); // Read the file as data URL
            }
        }
    </script>
</x-app-layout>
