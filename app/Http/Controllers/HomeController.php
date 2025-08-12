<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // UMKM populer berdasarkan rata-rata rating
        $popularUmkms = Umkm::withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take(6)
            ->get();

        // Produk unggulan berdasarkan rata-rata rating
        $topProducts = Product::withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take(6)
            ->get();

        return view('home', compact('popularUmkms', 'topProducts'));
    }
    public function tentang()
{
    return view('tentang');
}

}
