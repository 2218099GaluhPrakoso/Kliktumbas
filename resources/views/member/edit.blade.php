@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-primary bg-gradient text-white text-center py-3 rounded-top-4">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i> Edit Profil
            </h4>
        </div>
        <div class="card-body p-4">
            <form method="POST" action="{{ route('member.profile.update') }}" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" class="form-control rounded-3 shadow-sm" 
                           value="{{ $member->name }}" placeholder="Masukkan nama lengkap">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">No. Telp</label>
                    <input type="text" name="phone" class="form-control rounded-3 shadow-sm" 
                           value="{{ $member->phone }}" placeholder="Masukkan nomor telepon">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Jenis Kelamin</label>
                    <select name="gender" class="form-select rounded-3 shadow-sm">
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ $member->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $member->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Tanggal Lahir</label>
                    <input type="date" name="birth_date" class="form-control rounded-3 shadow-sm" 
                           value="{{ $member->birth_date }}">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Foto Profil</label><br>
                    @if ($member->profile_image)
                        <img src="{{ asset('profiles/' . $member->profile_image) }}" 
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" alt="Foto Profil">
                    @else
                        <img src="{{ asset('default-avatar.png') }}" 
                             class="rounded-circle shadow-sm mb-3" width="100" height="100" alt="Foto Profil">
                    @endif
                    <input type="file" name="profile_image" class="form-control rounded-3 shadow-sm">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('member.profile') }}" class="btn btn-secondary px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-success px-4 py-2 rounded-3 shadow-sm">
                        <i class="bi bi-check-circle"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .btn:hover {
        transform: translateY(-2px);
        transition: 0.2s ease-in-out;
    }
</style>
@endsection
