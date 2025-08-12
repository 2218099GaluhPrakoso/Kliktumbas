<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Klik Tumbas</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background: #f5f7fa;
            color: #333;
            line-height: 1.6;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #007cd0, #0091ea);
            padding: 16px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .navbar .logo {
            font-weight: bold;
            font-size: 24px;
        }
        .navbar .menu {
            display: flex;
            align-items: center;
            gap: 18px;
        }
        .navbar .menu a {
            color: white;
            font-size: 15px;
            text-decoration: none;
            transition: 0.3s;
            padding: 8px 12px;
            border-radius: 6px;
        }
        .navbar .menu a:hover {
            background: rgba(255,255,255,0.15);
        }
        .navbar input[type="text"] {
            padding: 8px 14px;
            border-radius: 20px;
            border: none;
            font-size: 14px;
            outline: none;
        }
        .profile-icon {
            margin-left: 10px;
            background: white;
            color: #0091ea;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            text-align: center;
            line-height: 38px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }
        .profile-icon:hover {
            background: #ffdd57;
            color: #333;
        }

        /* Banner */
        .banner {
            position: relative;
            margin: 20px auto;
            max-width: 1200px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .banner img {
            width: 100%;
            max-height: 450px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .banner img:hover {
            transform: scale(1.03);
        }

        /* Section Title */
        .section-title {
            font-size: 28px;
            font-weight: bold;
            margin: 50px 0 20px;
            text-align: center;
            color: #222;
            position: relative;
        }
        .section-title::after {
            content: "";
            width: 70px;
            height: 4px;
            background: linear-gradient(90deg, #0091ea, #007cd0);
            display: block;
            margin: 8px auto 0;
            border-radius: 4px;
        }

        /* Card Container */
        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 24px;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }

        /* Card */
        .card {
            background: white;
            border-radius: 14px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 22px rgba(0,0,0,0.15);
        }
        .card img {
            width: 150px;
            height: 150px;
            object-fit: contain;
            margin-bottom: 12px;
            transition: transform 0.3s ease;
        }
        .card:hover img {
            transform: scale(1.05);
        }
        .card div {
            margin-bottom: 6px;
        }

        /* Rating Stars */
        .rating i {
            font-size: 18px;
            cursor: pointer;
            margin: 1px;
            transition: color 0.2s;
        }
        .rating i:hover,
        .rating i.hovered {
            color: gold !important;
        }

        /* Button */
        .btn {
            margin-top: 20px;
            padding: 10px 25px;
            background: linear-gradient(90deg, #0091ea, #007cd0);
            border: none;
            color: white;
            border-radius: 25px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background: linear-gradient(90deg, #007cd0, #005fa3);
            transform: translateY(-2px);
        }

        /* Footer */
        footer {
            background: #007cd0;
            color: white;
            padding: 30px;
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
        }
        footer .info {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        /* Animasi Fade In */
        .fade-in {
            animation: fadeInUp 0.6s ease-in-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }
            .navbar .menu {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                margin-top: 10px;
            }
        }
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $(".rating i").on("mouseover", function(){
            let value = $(this).data("value");
            $(this).parent().find("i").each(function(index){
                $(this).toggleClass("hovered", index < value);
            });
        }).on("mouseout", function(){
            $(this).parent().find("i").removeClass("hovered");
        });

        $(".rating i").on("click", function(){
            let value = $(this).data("value");
            let id = $(this).parent().data("id");
            let type = $(this).parent().data("type");

            $.ajax({
                url: "{{ route('rating.store') }}",
                type: "POST",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: id,
                    type: type,
                    rating: value
                },
                success: function(res){
                    alert("Rating berhasil disimpan!");
                    location.reload();
                },
                error: function(){
                    alert("Gagal menyimpan rating, pastikan login terlebih dahulu.");
                }
            });
        });
    });
</script>

<body>
    <div class="navbar">
        <div class="logo">Klik <span style="color: yellow;">TUMBAS</span></div>
        <div class="menu">
            <a href="{{ route('home') }}">Beranda</a>
            <a href="{{ route('kategori.makanan', 'makanan') }}">Kategori</a>
            <a href="{{ route('tentang') }}">Tentang</a>
            @if(Auth::guard('admin')->check())
    <a href="{{ route('admin.profile') }}" class="profile-icon">👤</a>
@elseif(Auth::guard('member')->check()) {{-- web = member --}}
    <a href="{{ route('member.profile') }}" class="profile-icon">👤</a>
@else
    <a href="{{ route('login') }}" class="profile-icon">👤</a>
@endif
        </div>
    </div>

    <div class="banner fade-in">
        <img src="{{ asset('gambar/UMKM.png') }}" alt="Banner UMKM">
    </div>

    <div class="section-title fade-in">UMKM Populer</div>
    <div class="card-container fade-in">
        @foreach($popularUmkms as $umkm)
            <div class="card">
                <a href="{{ route('umkm.profile', $umkm->id) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ asset($umkm->image) }}" alt="{{ $umkm->name }}">
                    <div><strong>{{ $umkm->name }}</strong></div>
                </a>
                <div class="rating" data-id="{{ $umkm->id }}" data-type="umkm">
                    @php $rating = number_format($umkm->ratings_avg_rating, 1) ?? 0; @endphp
                    @for($i=1; $i<=5; $i++)
                        <i class="fa-star fa {{ $i <= $rating ? 'fas text-warning' : 'far text-muted' }}" data-value="{{ $i }}"></i>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>
    <div style="text-align:center;">
        <a href="{{ route('umkm.index') }}" class="btn">Lihat Semua UMKM</a>
    </div>

    <div class="section-title fade-in">Produk Unggulan</div>
    <div class="card-container fade-in">
        @foreach($topProducts as $product)
            <div class="card">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                <div><strong>{{ $product->name }}</strong></div>
                <div class="rating" data-id="{{ $product->id }}" data-type="product">
                    @php $rating = number_format($product->ratings_avg_rating, 1) ?? 0; @endphp
                    @for($i=1; $i<=5; $i++)
                        <i class="fa-star fa {{ $i <= $rating ? 'fas text-warning' : 'far text-muted' }}" data-value="{{ $i }}"></i>
                    @endfor
                </div>
            </div>
        @endforeach
    </div>
    <div style="text-align:center;">
        <a href="{{ route('produk.index') }}" class="btn">Lihat Semua Produk</a>
    </div>

    <footer>
        <div class="container info">
            <div><i class="fas fa-building"></i> kelurahantunjungsekar</div>
            <div><i class="fas fa-phone"></i> (0341) 497111</div>
            <div><i class="fas fa-map-marker-alt"></i> Jl. Piranha Atas No.206, Lowokwaru, Malang</div>
        </div>
    </footer>
</body>
</html>
