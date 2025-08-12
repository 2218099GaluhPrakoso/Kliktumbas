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
            <div class="col-md-3 d-flex align-items-center justify-content-center p-3">
              @if ($umkm->image)
    @php
        $finfo = finfo_open();
        $mimeType = finfo_buffer($finfo, $umkm->image, FILEINFO_MIME_TYPE);
        finfo_close($finfo);
    @endphp

    <img src="data:{{ $mimeType }};base64,{{ base64_encode($umkm->image) }}" 
         alt="{{ $umkm->name }}" 
         style="width:100%; height:200px; object-fit:cover;">
@else
    <img src="{{ asset('default-umkm.png') }}" 
         alt="{{ $umkm->name }}" 
         style="width:100%; height:200px; object-fit:cover;">
@endif
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <h3 class="card-title">{{ $umkm->name }}</h3>
                    <p class="text-muted">{{ $umkm->description }}</p>

                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <strong class="fs-4 text-warning">★ {{ $umkmAvg }}</strong>
                            <div class="text-muted small">({{ $umkm->ratings->count() }} penilai)</div>
                        </div>

                        <!-- Tombol beri rating (modal) -->
                        @auth('member')
    <div>
        <h6 class="mb-1">Beri Rating UMKM:</h6>
        <div id="umkm-star-rating" data-umkm-id="{{ $umkm->id }}">
            @for($i = 1; $i <= 5; $i++)
                <i class="fa fa-star umkm-star"
                   data-value="{{ $i }}"
                   style="font-size: 24px; color: {{ $i <= ($userUmkmRating ?? 0) ? '#ffc107' : '#ccc' }}; cursor: pointer;"></i>
            @endfor
        </div>
        <div id="umkm-rating-message" class="text-success small mt-1"></div>
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

    <!-- Daftar Produk UMKM -->
    <h5>Produk dari {{ $umkm->name }}</h5>
    <div class="row">
        @forelse($umkm->products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                         <img src="{{ asset($u->image) }}" alt="{{ $u->name }}" class="card-img-top" style="height:180px; object-fit:cover;">
                    @else
                        <img src="{{ asset('images/default-product.png') }}" class="card-img-top" style="height:180px; object-fit:cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-muted mb-1">Rp {{ number_format($product->price ?? 0,0,',','.') }}</p>
                        <div class="mb-2">
                            <strong class="text-warning">★ {{ $product->avg_rating }}</strong>
                            <span class="text-muted small">({{ $product->ratings->count() }})</span>
                        </div>
                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('product.show', $product->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>

                            @auth('member')
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#rateProductModal{{ $product->id }}">Beri Rating</button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-sm btn-outline-primary">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Rating Produk -->
            <div class="modal fade" id="rateProductModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('product.rate', $product->id) }}">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Rating: {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <label>Nilai (1-5)</label>
                                <select name="rating" class="form-select mb-2" required>
                                    @for($i=5;$i>=1;$i--)
                                        <option value="{{ $i }}">{{ $i }} ★</option>
                                    @endfor
                                </select>
                                <label>Komentar (opsional)</label>
                                <textarea name="comment" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-muted">Belum ada produk.</p>
        @endforelse
    </div>
</div>

<!-- Modal Rating UMKM -->
<div class="modal fade" id="rateUmkmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('umkm.rate', $umkm->id) }}">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rating untuk {{ $umkm->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label>Nilai (1-5)</label>
                    <select name="rating" class="form-select mb-2" required>
                        @for($i=5;$i>=1;$i--)
                            <option value="{{ $i }}">{{ $i }} ★</option>
                        @endfor
                    </select>
                    <label>Komentar (opsional)</label>
                    <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(function(){
    let selectedRating = {{ $userUmkmRating ?? 0 }};
    let umkmId = $('#umkm-star-rating').data('umkm-id');

    function highlightStars(count){
        $('.umkm-star').each(function(){
            $(this).css('color', $(this).data('value') <= count ? '#ffc107' : '#ccc');
        });
    }

    // Warna awal sesuai rating user
    highlightStars(selectedRating);

    // Hover efek
    $('.umkm-star').hover(
        function(){ highlightStars($(this).data('value')); },
        function(){ highlightStars(selectedRating); }
    );

    // Klik bintang kirim AJAX
    $('.umkm-star').click(function(){
        let value = $(this).data('value');
        selectedRating = value;

        $.ajax({
            url: "{{ route('umkm.rate') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                umkm_id: umkmId,
                rating: value
            },
            success: function(res){
                $('#umkm-rating-message').text(res.message).fadeIn().delay(1500).fadeOut();
                highlightStars(value);
            },
            error: function(){
                alert("Gagal menyimpan rating.");
            }
        });
    });
});
</script>
@endpush

