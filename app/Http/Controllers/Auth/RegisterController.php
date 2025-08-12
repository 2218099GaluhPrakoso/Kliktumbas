<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Sesuaikan lokasi file blade kamu
    }

    public function register(Request $request)
{
    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'gender' => 'required|string|max:10',
        'birth_date' => 'required|date',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
    ]);

    // Simpan user baru
    Member::create([
    'name' => $request->name,
    'phone' => $request->phone,
    'gender' => $request->gender,
    'birth_date' => $request->birth_date,
    'email' => $request->email,
    'password' => Hash::make($request->password),
]);

    // Redirect ke halaman login user
    return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
}

}
