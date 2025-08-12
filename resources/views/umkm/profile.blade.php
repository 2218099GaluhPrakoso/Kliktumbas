@extends('layouts.app')

@section('content')
<div class="umkm-profile">

    {{-- Header UMKM --}}
    <div class="header fade-in">
        <img src="{{ asset($umkm->image) }}" alt="{{ $umkm->name }}" class="umkm-avatar">
        <h2>{{ $umkm->name }}</h2>
        <div class="umkm-rating">⭐ {{ $umkmAvg }}</div>
    </div>

    {{-- 3 Produk Besar --}}
    <div class="section">
        <h3>Produk Unggulan</h3>
        <div class="product-grid-large">
            @foreach($products->take(3) as $product)
                <div class="product-card zoom-in">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <div class="product-info">
                        <strong>{{ $product->name }}</strong>
                        <div class="rating">⭐ {{ number_format($product->ratings->avg('rating') ?? 0, 1) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Semua Produk --}}
    <div class="section">
        <h3>Semua Produk</h3>
        <div class="product-grid-small">
            @foreach($products as $product)
                <div class="product-card fade-up">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <div class="product-info">
                        <strong>{{ $product->name }}</strong>
                        <div class="rating">⭐ {{ number_format($product->ratings->avg('rating') ?? 0, 1) }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Detail UMKM --}}
    <div class="details fade-in">
        <p><strong>📍 Alamat:</strong> {{ $umkm->alamat }}</p>
        <p><strong>📞 Telepon:</strong> {{ $umkm->telepon }}</p>
        <p><strong>ℹ️ Tentang UMKM:</strong> {{ $umkm->description }}</p>
    </div>
</div>

<style>
    .umkm-profile {
        padding: 20px;
        max-width: 1100px;
        margin: auto;
    }

    /* Header */
    .header {
        background: linear-gradient(to right, #3b82f6, #facc15);
        padding: 25px;
        border-radius: 12px;
        text-align: center;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: fadeIn 1s ease-in-out;
    }
    .umkm-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 3px solid white;
        margin-bottom: 10px;
        transition: transform 0.3s ease;
    }
    .umkm-avatar:hover {
        transform: scale(1.1);
    }
    .umkm-rating {
        color: #ffd700;
        font-size: 1.2rem;
        margin-top: 5px;
    }

    /* Section spacing */
    .section {
        margin-bottom: 35px;
    }
    .section h3 {
        margin-bottom: 15px;
        color: #333;
        font-weight: bold;
    }

    /* Produk Unggulan */
    .product-grid-large {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    /* Semua Produk */
    .product-grid-small {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
    }

    .product-card {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.2);
    }
    .product-card img {
        width: 100%;
        height: 150px;
        object-fit: contain;
        background: #f9f9f9;
        transition: transform 0.3s ease;
    }
    .product-card:hover img {
        transform: scale(1.05);
    }
    .product-info {
        padding: 10px;
        font-size: 0.95rem;
    }
    .rating {
        color: gold;
        font-size: 0.9rem;
    }

    /* Detail UMKM */
    .details {
        margin-top: 10px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        font-size: 1rem;
        line-height: 1.6;
    }
    .details p {
        margin-bottom: 8px;
    }

    /* Animations */
    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(10px);}
        to {opacity: 1; transform: translateY(0);}
    }
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }
    .fade-up {
        animation: fadeIn 1s ease-in-out;
    }
    .zoom-in {
        animation: zoomIn 0.8s ease-in-out;
    }
    @keyframes zoomIn {
        from {opacity: 0; transform: scale(0.9);}
        to {opacity: 1; transform: scale(1);}
    }
</style>
@endsection
