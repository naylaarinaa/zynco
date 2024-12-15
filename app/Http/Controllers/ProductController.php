<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $category = $request->input('category');

        // Query for products
        $products = Product::query();

        // Apply search query if provided
        if ($query) {
            $products->where('name', 'LIKE', "%{$query}%")
                     ->orWhere('category', 'LIKE', "%{$query}%");
        }

        // Apply category filter if provided
        if ($category) {
            $products->where('category', $category);
        }

        // Get the results
        $products = $products->get();
        foreach ($products as $product) {
            if ($product->image_url) {
                $product->image_url = 'data:image/jpeg;base64,' . base64_encode($product->image_url);
            }
        }

        return view('products.index', compact('products', 'query', 'category'));
    }

    public function search(Request $request)
    {
        return $this->index($request); // Redirect to the index method with the same request
    }

    public function addView()
    {
        return view('products.add'); // Show the add product form
    }

    public function addStore(Request $request): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
            'price' => 'required|numeric|min:0',
        ]);

        // Save image as blob
        $imageBlob = file_get_contents($request->file('image')->getRealPath());

        // Create a new product
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'image_url' => $imageBlob,
            'price' => $request->price,
        ]);

        return redirect()->route('shop.index')->with('success', 'Product added successfully!'); // Success message
    }

    public function editView()
    {
        // Retrieve all products for editing
        $products = Product::all();
        foreach ($products as $product) {
            if ($product->image_url) {
                $product->image_url = 'data:image/jpeg;base64,' . base64_encode($product->image_url);
            }
        }
        
        return view('products.edit', compact('products')); // Show edit view with existing products
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id); // Retrieve the product by its ID
        return view('products.edit-form', compact('product')); // Return edit view with product data
    }

    public function update(Request $request, $id): RedirectResponse
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Optional image
            'price' => 'required|numeric|min:0',
        ]);

        $product = Product::findOrFail($id); // Retrieve the product by its ID

        // Update product details
        $product->name = $request->name;
        $product->category = $request->category;
        $product->price = $request->price;

        // If a new image is uploaded, store it as blob
        if ($request->hasFile('image')) {
            $imageBlob = file_get_contents($request->file('image')->getRealPath());
            $product->image_url = $imageBlob;
        }

        $product->save(); // Save changes
        return redirect()->route('shop.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete(); // Delete the product
        return redirect()->route('shop.index')->with('success', 'Product deleted successfully.');
    }

    // Display the cart page
    public function cart()
    {
        $cart = session()->get('cart', []); // Ambil data keranjang dari sesi
        return view('products.cart', compact('cart')); // Kirim data keranjang ke tampilan
    }
    

    
public function addToCart(Request $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->withErrors(['message' => 'Product not found']);
    }

    $cart = session()->get('cart', []);

    // Ambil data gambar dan konversi ke Base64 jika ada
    $imageUrl = null;
    if ($product->image) {
        $imagePath = public_path('images/' . $product->image); // Sesuaikan path gambar
        if (file_exists($imagePath)) {
            $imageData = file_get_contents($imagePath);
            $imageUrl = 'data:image/jpeg;base64,' . base64_encode($imageData);
        }
    }

    // Tambahkan produk ke keranjang
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $request->input('quantity', 1);
    } else {
        $cart[$id] = [
            'name' => $product->name,
            'quantity' => $request->input('quantity', 1),
            'price' => $product->price,
            'image_url' => $imageUrl, // Masukkan Base64 image atau null jika tidak ada
        ];
    }

    session()->put('cart', $cart);
    return redirect()->route('shop.index')->with('success', 'Product added to cart successfully!');
}


    

    // Remove product from cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart');

        // If product exists in cart, remove it
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true, 'message' => 'Product removed from cart successfully.']);
    }

    public function checkout(Request $request)
    {
        $cart = session()->get('cart', []);
        $selectedProducts = [];

        // Retrieve selected products
        foreach ($request->input('products', []) as $id => $product) {
            if (isset($cart[$id])) {
                $selectedProducts[$id] = $cart[$id];
                $selectedProducts[$id]['quantity'] = $product['quantity'];
            }
        }

        // Ensure products are selected
        if (!empty($selectedProducts)) {
            return view('products.checkout', compact('selectedProducts'));
        }

        return redirect()->route('cart.index')->with('error', 'No products selected!');
    }

    // Method to complete checkout transaction
    public function processCheckout(Request $request)
    {
        // Clear the cart after checkout is complete
        session()->forget('cart'); // Empty the cart
        return redirect()->route('cart.index')->with('success', 'Checkout completed successfully!');
    }
}
