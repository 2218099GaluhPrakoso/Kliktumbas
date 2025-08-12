@extends('layouts.app')

@section('content')
<style>
    body, html {
        height: 100%;
        background-color: #f9f9f9;
    }

    .main-wrapper {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    .content {
        flex: 1;
    }

    .product-section {
        padding: 40px 20px;
        max-width: 1300px;
        margin: auto;
        animation: fadeIn 0.8s ease-in-out;
    }

    .product-title {
        font-size: 26px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        color: #222;
        position: relative;
    }

    .product-title::after {
        content: '';
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #ff9800, #ff5722);
        display: block;
        margin: 8px auto 0;
        border-radius: 2px;
    }

    .product-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
    }

    .product-card {
        background-color: white;
        border: none;
        width: 160px;
        padding: 15px 10px;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transform: translateY(20px);
        opacity: 0;
        animation: slideUp 0.6s ease forwards;
    }

    /* Delay animasi tiap kartu */
    .product-card:nth-child(1) { animation-delay: 0.1s; }
    .product-card:nth-child(2) { animation-delay: 0.2s; }
    .product-card:nth-child(3) { animation-delay: 0.3s; }
    .product-card:nth-child(4) { animation-delay: 0.4s; }
    .product-card:nth-child(5) { animation-delay: 0.5s; }
    .product-card:nth-child(6) { animation-delay: 0.6s; }

    .product-card:hover {
        transform: translateY(-8px) scale(1.05);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .product-card img {
        width: 100%;
        height: 150px;
        object-fit: contain;
        margin-bottom: 8px;
        transition: transform 0.3s ease;
    }

    .product-card:hover img {
        transform: scale(1.1);
    }

    .product-name {
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 4px;
        color: #333;
    }

    .product-rating {
        font-size: 13px;
        color: #ff9800;
    }

    footer {
        background-color: #0099ff;
        color: white;
        padding: 16px;
        font-size: 14px;
        box-shadow: 0 -2px 8px rgba(0,0,0,0.05);
    }

    footer .info {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    @media(min-width: 576px) {
        footer .info {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    @keyframes slideUp {
        0% {
            transform: translateY(20px);
            opacity: 0;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
        }
    }
</style>

<div class="main-wrapper">
    <div class="content">
        <div class="product-section">
            <div class="product-title">✨ Semua Produk Unggulan ✨</div>
            <div class="product-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                        <div class="product-name">{{ $product->name }}</div>
                        <div class="product-rating">⭐ {{ number_format($product->rating, 1) }} </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

   
</div>
@endsection
