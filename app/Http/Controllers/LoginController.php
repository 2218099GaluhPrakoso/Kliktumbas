<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan file ini ada: resources/views/auth/login.blade.php
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $member = Member::where('name', $request->name)
                        ->where('phone', $request->phone)
                        ->first();

        if ($member) {
            Auth::guard('member')->login($member); // ✅ login pakai guard 'member'
            return redirect()->route('member.profile'); // Ganti dengan rute tujuan setelah login
        }

        return back()->withErrors(['login' => 'Nama atau nomor telepon salah']);
    }

    public function logout(Request $request)
    {
        Auth::guard('member')->logout(); // ✅ logout pakai guard 'member'
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
