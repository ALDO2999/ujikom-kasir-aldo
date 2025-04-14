<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Ambil semua produk + relasi orderDetails
        $products = Product::with('orderDetails')->get();

        if ($user->role === 'admin') {
            return view('admin.product.index', compact('products'));
        } elseif ($user->role === 'petugas') {
            return view('petugas.product.index', compact('products'));
        }

        return abort(403, 'Unauthorized');
    }

    public function create()
    {
        $products = Product::all();
        return view('admin.product.create', compact('products'));
    }


    public function list(){
        $products = Product::all();
        return response()->json($products);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name'  => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('product_image')) {
            $validated['product_image'] = $request->file('product_image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.product.index')->with('status', 'Produk berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.show', compact('product'));
    }

    public function edit(string $id)
    {

        $products = Product::findOrFail($id);
        return view('admin.product.edit', compact('products'));
    }
    public function update(Request $request, $id)
    {

        // dd($request);
        $request->merge([
            'price' => str_replace(['Rp.', '.', ' '], '', $request->price),
        ]);
    
        // Validasi
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
    
        if ($request->hasFile('product_image')) {
            // Hapus gambar lama jika ada
            if ($product->product_image && file_exists(public_path('products/' . $product->product_image))) {
                unlink(public_path('products/' . $product->product_image));
            }
    
            $product_image = $request->file('product_image');
            $imageName = time() . '_' . $product_image->getClientOriginalName();
            $product_image->move(public_path('products'), $imageName);
    
            $validated['product_image'] = $imageName;
        }
    
        // Update data produk
        $product->update($validated);
    
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui.');
    }


    public function updateStock(Request $request, $id){

        $product = Product::findOrFail($id);
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('admin.product.index')->with('status', 'Berhasil update data stock');

    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.product.index')->with('status', 'Produk berhasil dihapus.');
    }
}
