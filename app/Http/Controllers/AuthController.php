<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showAdminLoginForm()
    {
        return view('auth.login_admin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $user = User::where('name', $request->name)
            ->where('phone', $request->phone)
            ->where('role', 'user')
            ->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('Home');
        }

        return back()->withErrors(['login' => 'Nama atau No Telepon salah!']);
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $admin = User::where('name', $request->name)
            ->where('phone', $request->phone)
            ->where('role', 'admin')
            ->first();

        if ($admin) {
            Auth::login($admin);
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['login' => 'Nama atau No Telepon salah!']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'gender' => 'required',
            'birth_date' => 'required|date',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        Auth::login($user);
        return redirect()->route('Home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
