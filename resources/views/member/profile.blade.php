@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        
        {{-- Header Profil --}}
        <div class="card-header text-center text-white" style="background: linear-gradient(90deg, #ff9800, #ff5722); padding: 40px 20px;">
            <img src="{{ $member->profile_image ? asset('profiles/' . $member->profile_image) : asset('default-avatar.png') }}"
                 class="rounded-circle border border-3 border-white shadow"
                 width="120" height="120" alt="Profile Picture">
            <h4 class="mt-3 mb-0">{{ strtoupper($member->name) }}</h4>
            <small class="text-light">Member KlikTumbas</small>
        </div>

        {{-- Detail Profil --}}
        <div class="card-body p-4" style="background-color: #fffdf8;">
            <table class="table table-striped table-hover mb-4">
                <tbody>
                    <tr>
                        <th style="width: 40%">📛 Nama</th>
                        <td>{{ $member->name }}</td>
                    </tr>
                    <tr>
                        <th>📱 No. Telp</th>
                        <td>{{ $member->phone }}</td>
                    </tr>
                    <tr>
                        <th>⚧ Jenis Kelamin</th>
                        <td>{{ $member->gender ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>🎂 Tanggal Lahir</th>
                        <td>{{ $member->birth_date ?? '-' }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('member.profile.edit') }}" class="btn btn-warning px-4 py-2 rounded-pill fw-bold">
                    ✏️ Edit Profil
                </a>
                
                <form action="{{ route('member.logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill fw-bold">
                        🚪 Keluar
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
