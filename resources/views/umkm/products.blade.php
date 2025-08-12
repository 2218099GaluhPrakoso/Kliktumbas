@extends('layouts.app')

@section('content')
<div class="umkm-products">
    <h2>Produk dari {{ $umkm->name }}</h2>

    <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px;">
        @foreach($products as $product)
            <div style="width: 200px; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 150px; object-fit: cover;">
                <div style="padding: 10px;">
                    <strong>{{ $product->name }}</strong>
                    <div style="color: gold;">⭐ {{ number_format($product->ratings->avg('rating') ?? 0, 1) }}</div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
