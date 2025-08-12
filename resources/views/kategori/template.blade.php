@extends('layouts.app')

@section('content')
<div class="container my-4">

    {{-- Tabs kategori --}}
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-4 animate__animated animate__fadeInDown">
        <a href="{{ route('kategori.minuman') }}" 
           class="btn {{ request()->routeIs('kategori.minuman') ? 'btn-primary shadow' : 'btn-outline-primary' }} px-4 py-2 fw-bold rounded-pill transition-all">
           🥤 Minuman
        </a>
        <a href="{{ route('kategori.makanan') }}" 
           class="btn {{ request()->routeIs('kategori.makanan') ? 'btn-primary shadow' : 'btn-outline-primary' }} px-4 py-2 fw-bold rounded-pill transition-all">
           🍛 Makanan
        </a>
        <a href="{{ route('kategori.snack') }}" 
           class="btn {{ request()->routeIs('kategori.snack') ? 'btn-primary shadow' : 'btn-outline-primary' }} px-4 py-2 fw-bold rounded-pill transition-all">
           🍪 Snack
        </a>
    </div>

   {{-- Hero Image --}}
<div class="text-center mb-4 animate__animated animate__zoomIn">
    <img src="{{ $heroImage }}"
         class="img-fluid rounded shadow-lg hero-img"
         alt="Hero"
         style="width: 100%; max-width: 600px; height: 250px; object-fit: cover; object-position: center;">
</div>


    {{-- Produk List --}}
    <h3 class="text-center fw-bold mb-3 animate__animated animate__fadeInUp">Produk Pilihan</h3>
    <div class="row justify-content-center mb-4">
        @foreach($products as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 animate__animated animate__fadeInUp">
                <div class="card product-card h-100">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                         style="width:100%; height:150px; object-fit:contain; padding:10px;">
                    <div class="card-body text-center p-2">
                        <p class="mb-1 fw-bold">{{ $product->name }}</p>
                       <small class="text-warning">
    <i class="fas fa-star"></i> {{ number_format($product->ratings_avg_rating, 1) }}
</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 3 Gambar Besar --}}
    <div class="row mb-4">
        @foreach($images as $img)
            <div class="col-12 col-sm-6 col-md-4 mb-2 animate__animated animate__fadeInUp">
                <img src="{{ $img }}" 
                     class="img-fluid rounded shadow-lg big-image"
                     style="width: 100%; height: 200px; object-fit: cover;">
            </div>
        @endforeach
    </div>

    {{-- Produk Rating Tertinggi --}}
    <h3 class="text-center fw-bold mb-3 animate__animated animate__fadeInUp">⭐ Produk Rating Tertinggi</h3>
    <div class="row justify-content-center">
        @foreach($topRated as $product)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 animate__animated animate__fadeInUp">
                <div class="card product-card h-100">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                         style="width:100%; height:150px; object-fit:contain; padding:10px;">
                    <div class="card-body text-center p-2">
                        <p class="mb-1 fw-bold">{{ $product->name }}</p>
                       <small class="text-warning">
    <i class="fas fa-star"></i> {{ number_format($product->ratings_avg_rating, 1) }}
</small>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>

{{-- Animasi dan Efek Hover --}}
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 12px;
        background: #fff;
    }
    .product-card:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    .big-image {
        transition: transform 0.4s ease;
    }
    .big-image:hover {
        transform: scale(1.05);
    }
    .hero-img {
        transition: transform 0.5s ease;
    }
    .hero-img:hover {
        transform: scale(1.03);
    }

    /* Untuk tablet dan HP */
@media (max-width: 768px) {
    .hero-img {
        max-width: 100%;
        height: 180px;  /* sedikit lebih rendah di HP */
    }
}

/* Untuk layar kecil sekali */
@media (max-width: 480px) {
    .hero-img {
        height: 150px;  /* lebih kecil lagi */
    }
    }
</style>
@endsection
