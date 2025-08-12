{{-- resources/views/tentang.blade.php --}}
@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<div class="bg-light py-5">
    <div class="container">

        {{-- Judul --}}
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">
                Klik <span class="text-warning fst-italic">TUMBAS</span>
            </h2>
        </div>

        {{-- Deskripsi --}}
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="fs-5 text-justify">
                    {{ $tentang['deskripsi_1'] ?? 'Tumbas adalah sebuah inisiatif pengembangan UMKM yang lahir dari semangat pemberdayaan ekonomi lokal di Kelurahan Tunjungsekar, Kecamatan Lowokwaru, Kota Malang. 
                    Program ini hadir sebagai wadah kolaboratif yang mempertemukan para pelaku usaha mikro, kecil, dan menengah dengan masyarakat luas melalui sistem informasi digital yang mudah diakses.' }}
                </p>
                <p class="fs-5 text-justify">
                    {{ $tentang['deskripsi_2'] ?? 'Nama Tumbas, yang dalam bahasa Jawa berarti membeli, mencerminkan tujuan utama kami: mengajak masyarakat untuk mencintai dan membeli produk lokal sebagai bentuk dukungan nyata terhadap UMKM di sekitar mereka. 
                    Lewat platform ini, kami membantu pelaku UMKM untuk mempromosikan produknya, memperluas jangkauan pasar, dan meningkatkan daya saing secara berkelanjutan.' }}
                </p>
            </div>
        </div>

        {{-- Kontak & Sosial Media --}}
        <div class="bg-primary text-white mt-5 rounded shadow p-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <p class="mb-1">
                        📷 {{ $tentang['instagram'] ?? 'kelurahantunjungsekar' }}
                    </p>
                    <p class="mb-1">
                        📞 {{ $tentang['telepon'] ?? '(0341) 497111' }}
                    </p>
                    <p class="mb-0">
                        📍 {{ $tentang['alamat'] ?? 'Jl. Piranha Atas No.206, Lowokwaru, Malang' }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end text-center mt-3 mt-md-0">
                    <a href="{{ url('/') }}" class="btn btn-warning fw-bold">
                        <i class="bi bi-house-door-fill"></i> Beranda
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
