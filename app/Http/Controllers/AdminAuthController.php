<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // <- ini yang kurang

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }

  public function login(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'password' => 'required|string',
    ]);

    $admin = User::where('name', $request->name)
        ->where('role', 'admin')
        ->first();

    if ($admin && Hash::check($request->password, $admin->password)) {
        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.profile');
    }

    return back()->withErrors([
        'login' => 'Nama atau password admin salah.',
    ]);
}

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
