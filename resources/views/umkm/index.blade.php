@extends('layouts.app')

@section('content')
<!-- AOS CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

<div class="main-wrapper py-4">

    <div class="content container">
        <div class="umkm-section">
            <h2 class="section-title" data-aos="fade-down">🌟 Semua UMKM Populer</h2>
            
            <div class="umkm-grid">
                @foreach($umkms as $index => $umkm)
                    <a href="{{ route('umkm.profile', $umkm->id) }}" 
                       class="umkm-card" 
                       data-aos="zoom-in" 
                       data-aos-delay="{{ $index * 100 }}">
                        <img src="{{ asset($umkm->image) }}" 
                             alt="{{ $umkm->name }}" 
                             class="umkm-image">
                        <div class="umkm-info">
                            <div class="umkm-name">{{ $umkm->name }}</div>
                            <div class="umkm-rating">⭐ {{ number_format($umkm->rating, 1) }} ({{ $umkm->review_count }})</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- AOS JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>

<style>
    .section-title {
        font-weight: bold;
        font-size: 24px;
        margin-bottom: 20px;
        text-align: center;
        color: #333;
    }

    .umkm-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
    }

    .umkm-card {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #fff;
        border: none;
        padding: 15px;
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
    }

    .umkm-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }

    .umkm-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        border: 2px solid #eee;
    }

    .umkm-info {
        flex: 1;
        text-align: left;
    }

    .umkm-name {
        font-weight: 600;
        font-size: 16px;
        color: #222;
        margin-bottom: 4px;
    }

    .umkm-rating {
        color: #ff9800;
        font-size: 14px;
    }

    @media (max-width: 576px) {
        .umkm-card {
            flex-direction: column;
            text-align: center;
        }
        .umkm-info {
            text-align: center;
        }
    }
</style>
@endsection
