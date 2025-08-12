<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $umkms = Umkm::with('products')->get();
        $products = Product::with('umkm')->get();
        return view('admin.dashboard', compact('umkms','products'));
    }

    public function storeUmkm(Request $request) {
        $request->validate(['name'=>'required','image'=>'nullable|image']);
        $data = $request->only('name','description');
        if($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('umkm_images','public');
        }
        Umkm::create($data);
        return back()->with('success','UMKM ditambahkan');
    }

    public function storeProduct(Request $request) {
    $request->validate([
        'umkm_id'   => 'required',
        'name'      => 'required',
        'price'     => 'required|numeric',
        'category'  => 'required|string',
        'image'     => 'nullable|image'
    ]);


    $data = $request->only('umkm_id', 'name', 'description', 'price', 'category');

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('product_images', 'public');
    }

    Product::create($data);

    return back()->with('success', 'Produk berhasil ditambahkan');
}

}

