<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile', compact('admin'));
    }
}

