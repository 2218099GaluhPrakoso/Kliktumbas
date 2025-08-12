<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Umkm;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('umkm')->get();
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $umkms = Umkm::all();
        return view('admin.product.create', compact('umkms'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'umkm_id' => 'required|exists:umkms,id',
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product_images', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $umkms = Umkm::all();
        return view('admin.product.edit', compact('product', 'umkms'));
    }

    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'umkm_id' => 'required|exists:umkms,id',
            'name' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('product_images', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }
}
