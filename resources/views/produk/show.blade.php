@extends('layouts.app')
@section('styles')
<style>
    .rating i {
        font-size: 24px;
        cursor: pointer;
        margin: 2px;
        transition: color 0.2s;
    }
    .rating i:hover,
    .rating i.hovered {
        color: gold !important;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="row g-0">
            <div class="col-md-4 p-3">
              @if(Str::startsWith($product->image, ['http', 'https']))
    {{-- Kalau URL langsung --}}
     <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width:150px; height:150px; object-fit:contain;">
@else
    {{-- Kalau file di folder public/storage --}}
    <img src="{{ asset('storage/' . $product->image) }}" 
         alt="{{ $product->name }}" 
         style="width:100%; height:200px; object-fit:cover;">
@endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h3>{{ $product->name }}</h3>
                    <p class="text-muted">UMKM: 
                        <a href="{{ route('umkm.show', $product->umkm->id) }}">{{ $product->umkm->name }}</a>
                    </p>
                    <p class="fs-5 text-primary">Rp {{ number_format($product->price ?? 0,0,',','.') }}</p>
                    <p>{{ $product->description }}</p>

                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <strong class="fs-4 text-warning">★ {{ $productAvg }}</strong>
                            <div class="text-muted small">({{ $product->ratings->count() }} penilai)</div>
                        </div>

                        @auth('member')
    <div>
        <h6 class="mb-1">Beri Rating Produk:</h6>
        <div id="star-rating" data-product-id="{{ $product->id }}">
            @for($i = 1; $i <= 5; $i++)
                <i class="fa fa-star star"
                   data-value="{{ $i }}"
                   style="font-size: 24px; color: {{ $i <= ($userRating ?? 0) ? '#ffc107' : '#ccc' }}; cursor: pointer;"></i>
            @endfor
        </div>
        <div id="rating-message" class="text-success small mt-1"></div>
    </div>
@else
    <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
        Login untuk beri rating
    </a>
@endauth

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    let selectedRating = {{ $userRating ?? 0 }};
    let productId = $('#star-rating').data('product-id');

    function highlightStars(count){
        $('.star').each(function(){
            $(this).css('color', $(this).data('value') <= count ? '#ffc107' : '#ccc');
        });
    }

    highlightStars(selectedRating);


    $('.star').hover(
        function(){ highlightStars($(this).data('value')); },
        function(){ highlightStars(selectedRating); }
    );


    $('.star').click(function(){
        let value = $(this).data('value');
        selectedRating = value;

        $.ajax({
            url: "{{ route('product.rate') }}", 
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                rating: value
            },
            success: function(res){
                $('#rating-message').text(res.message).fadeIn().delay(1500).fadeOut();
                highlightStars(value);
            },
            error: function(xhr){
                alert("Gagal mengirim rating.");
            }
        });
    });
});
</script>
@endpush

