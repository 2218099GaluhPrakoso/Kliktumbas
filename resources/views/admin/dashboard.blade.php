@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="mb-3">
        <a href="{{ route('admin.profile') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Animasi Fade-in --}}
    <style>
        .fade-in {
            animation: fadeIn 0.6s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }
        .table img {
            transition: transform 0.2s ease;
        }
        .table img:hover {
            transform: scale(1.05);
        }
        .card-header {
            letter-spacing: 0.5px;
        }
    </style>

    {{-- Form Tambah UMKM --}}
    <div class="card mb-4 shadow-sm border-0 fade-in">
        <div class="card-header bg-primary text-white fw-bold">
            <i class="bi bi-shop"></i> Tambah UMKM
        </div>
        <div class="card-body">
            <form action="{{ route('admin.umkm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="mb-3 fw-semibold">Isi data UMKM baru</h5>
                <input type="text" name="name" class="form-control mb-3" placeholder="Nama UMKM" required>
                <textarea name="description" class="form-control mb-3" placeholder="Deskripsi" rows="3" required></textarea>
                <input type="text" name="alamat" class="form-control mb-3" placeholder="Alamat" required>
                <input type="text" name="telepon" class="form-control mb-3" placeholder="Telepon" required>
                <input type="file" name="image" class="form-control mb-3">
                <button class="btn btn-success px-4"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>

    {{-- Form Tambah Produk --}}
    <div class="card mb-4 shadow-sm border-0 fade-in">
        <div class="card-header bg-success text-white fw-bold">
            <i class="bi bi-box-seam"></i> Tambah Produk
        </div>
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h5 class="mb-3 fw-semibold">Isi data Produk baru</h5>
                <select name="umkm_id" class="form-control mb-3" required>
                    <option value="">-- Pilih UMKM --</option>
                    @foreach($umkms as $umkm)
                        <option value="{{ $umkm->id }}">{{ $umkm->name }}</option>
                    @endforeach
                </select>
                <input type="text" name="name" class="form-control mb-3" placeholder="Nama Produk" required>
                <select name="category" class="form-control mb-3">
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Snack">Snack</option>
                </select>
                <textarea name="description" class="form-control mb-3" placeholder="Deskripsi" rows="3" required></textarea>
                <input type="number" name="price" class="form-control mb-3" placeholder="Harga" required>
                <input type="file" name="image" class="form-control mb-3">
                <button class="btn btn-success px-4"><i class="bi bi-save"></i> Simpan</button>
            </form>
        </div>
    </div>

    {{-- List UMKM --}}
    <div class="card mb-4 shadow-sm border-0 fade-in">
        <div class="card-header bg-info text-white fw-bold">
            <i class="bi bi-list"></i> Daftar UMKM
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Alamat</th>
                        <th>Telepon</th>
                        <th>Gambar</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($umkms as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->description }}</td>
                            <td>{{ $u->alamat }}</td>
                            <td>{{ $u->telepon }}</td>
                            <td>
                                @if($u->image)
                                    <img src="{{ asset($u->image) }}" alt="{{ $u->name }}" width="100" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editUMKM{{ $u->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('admin.umkm.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus UMKM ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- List Produk --}}
    <div class="card mb-4 shadow-sm border-0 fade-in">
        <div class="card-header bg-warning fw-bold">
            <i class="bi bi-bag"></i> Daftar Produk
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>UMKM</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->category }}</td>
                            <td>{{ $p->umkm->name }}</td>
                            <td>Rp {{ number_format($p->price) }}</td>
                            <td>
                                @if($p->image)
                                    <img src="{{ asset($p->image) }}" alt="{{ $p->name }}" width="100" class="rounded shadow-sm">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProduk{{ $p->id }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <form action="{{ route('admin.product.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal Edit UMKM --}}
    @foreach($umkms as $u)
        <div class="modal fade" id="editUMKM{{ $u->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('admin.umkm.update', $u->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit UMKM</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="name" value="{{ $u->name }}" class="form-control mb-2" required>
                        <textarea name="description" class="form-control mb-2" required>{{ $u->description }}</textarea>
                        <input type="text" name="alamat" value="{{ $u->alamat }}" class="form-control mb-2" required>
                        <input type="text" name="telepon" value="{{ $u->telepon }}" class="form-control mb-2" required>
                        <input type="file" name="image" class="form-control mb-2">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Modal Edit Produk --}}
    @foreach($products as $p)
        <div class="modal fade" id="editProduk{{ $p->id }}" tabindex="-1">
            <div class="modal-dialog">
                <form action="{{ route('admin.product.update', $p->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Edit Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <select name="umkm_id" class="form-control mb-2">
                            @foreach($umkms as $umkm)
                                <option value="{{ $umkm->id }}" @if($umkm->id == $p->umkm_id) selected @endif>{{ $umkm->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" name="name" value="{{ $p->name }}" class="form-control mb-2" required>
                        <select name="category" class="form-control mb-2">
                            <option value="Makanan" {{ $p->category == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Minuman" {{ $p->category == 'Minuman' ? 'selected' : '' }}>Minuman</option>
                            <option value="Snack" {{ $p->category == 'Snack' ? 'selected' : '' }}>Snack</option>
                        </select>
                        <textarea name="description" class="form-control mb-2" required>{{ $p->description }}</textarea>
                        <input type="number" name="price" value="{{ $p->price }}" class="form-control mb-2" required>
                        <input type="file" name="image" class="form-control mb-2">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success"><i class="bi bi-save"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

</div>
@endsection
