<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Product;

class AdminController extends Controller
{
    public function dashboard()
    {
        $umkms = Umkm::with('products', 'ratings')->get();
        $products = Product::with('umkm', 'ratings')->get();

        return view('admin.dashboard', compact('umkms', 'products'));
    }
}
