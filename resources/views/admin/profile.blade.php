@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        
        {{-- Header Profil Admin --}}
        <div class="card-header text-center text-white" style="background: linear-gradient(90deg, #ff9800, #ff5722); padding: 40px 20px;">
            <img src="{{ asset('profiles/1754589735.png') }}" alt="Admin Profile" style="width:80px; height:80px; border-radius:50%;">
                            <h4 class="mt-3 mb-0">{{ strtoupper($admin->name) }}</h4>
            <small class="text-light">Administrator KlikTumbas</small>
        </div>

        {{-- Detail Profil --}}
        <div class="card-body p-4" style="background-color: #fffdf8;">
            <table class="table table-striped table-hover mb-4">
                <tbody>
                    <tr>
                        <th style="width: 40%">📛 Nama</th>
                        <td>{{ $admin->name }}</td>
                    </tr>
                    <tr>
                        <th>📧 Email</th>
                        <td>{{ $admin->email }}</td>
                    </tr>
                    <tr>
                        <th>📱 No. Telp</th>
                        <td>{{ $admin->phone ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>⚧ Jenis Kelamin</th>
                        <td>{{ $admin->gender ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>🎂 Tanggal Lahir</th>
                        <td>{{ $admin->birth_date ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>🛡 Role</th>
                        <td>{{ ucfirst($admin->role) }}</td>
                    </tr>
                </tbody>
            </table>

            {{-- Tombol Aksi --}}
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('admin/dashboard') }}" class="btn btn-primary px-4 py-2 rounded-pill fw-bold">
                    📊 Masuk Dashboard Admin
                </a>

                <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
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
