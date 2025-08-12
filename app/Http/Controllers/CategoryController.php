<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CategoryController extends Controller
{
    private function getCategoryData($category, $heroImage, $view)
{
    $products = Product::withAvg('ratings', 'rating')
        ->where('category', $category)
        ->get();

    $topRated = Product::withAvg('ratings', 'rating')
        ->where('category', $category)
        ->orderByDesc('ratings_avg_rating')
        ->take(5)
        ->get();

    $images = [
        asset('gambar/event/cewe.jpg'),
        asset('gambar/event/cowo.jpg'),
        asset('gambar/event/tenda.png')
    ];

    return view($view, compact('products', 'topRated', 'images', 'heroImage'));
}

    public function makanan()
    {
        return $this->getCategoryData(
            'Makanan',
            asset('gambar/makanan/makananhero.jpeg'),
            'kategori.makanan'
        );
    }

    public function minuman()
    {
        return $this->getCategoryData(
            'Minuman',
            asset('gambar/minuman/herominuman.jpg'),
            'kategori.minuman'
        );
    }

    public function snack()
    {
        return $this->getCategoryData(
            'Snack',
            asset('gambar/snack/snack.jpg'),
            'kategori.snack'
        );
    }
}
