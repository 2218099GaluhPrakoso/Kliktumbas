<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'umkm_id' => 'required|exists:umkms,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category' => 'required|in:Makanan,Minuman,Snack',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only(['umkm_id', 'name', 'description', 'price', 'category']);

    if ($request->hasFile('image')) {
    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('umkm_images'), $filename);
    $data['image'] = 'umkm_images/' . $filename;
}


    Product::create($data);

    return back()->with('success', 'Produk berhasil ditambahkan.');
}


    public function update(Request $request, $id)
{
    $request->validate([
        'umkm_id' => 'required|exists:umkms,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category' => 'required|in:Makanan,Minuman,Snack',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $product = Product::findOrFail($id);
    $product->umkm_id = $request->umkm_id;
    $product->name = $request->name;
    $product->description = $request->description;
    $product->price = $request->price;
    $product->category = $request->category; // ← tambahkan ini

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $imageName);
        $product->image = $imageName;
    }

    $product->save();
    return redirect()->back()->with('success', 'Produk berhasil diperbarui');
}

public function all() {
    return Umkm::select('id','name','logo')
        ->withAvg('ratings', 'rating')
        ->get()
        ->map(function($item){
            $item->rating = number_format($item->ratings_avg_rating, 1);
            return $item;
        });
}

public function index()
{
    $products = Product::leftJoin('product_ratings', 'products.id', '=', 'product_ratings.product_id')
        ->select(
            'products.id',
            'products.name',
            'products.description',
            'products.image',
            DB::raw('COALESCE(AVG(product_ratings.rating), 0) as rating'),
            DB::raw('COUNT(product_ratings.id) as review_count')
        )
        ->groupBy('products.id', 'products.name', 'products.description', 'products.image')
        ->get();

    return view('produk.index', compact('products'));
}

public function destroy($id)
{
    $product = Product::findOrFail($id);

    if ($product->image) {
        $storagePath = storage_path('app/public/' . $product->image);
        if (file_exists($storagePath)) {
            unlink($storagePath);
        }

        $publicPath = public_path('uploads/' . $product->image);
        if (file_exists($publicPath)) {
            unlink($publicPath);
        }
    }

    $product->delete();

    return redirect()->back()->with('success', 'Produk berhasil dihapus.');
}
}
