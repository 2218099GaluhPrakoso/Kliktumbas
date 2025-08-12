<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function profile()
    {
        $member = Auth::guard('member')->user();
        return view('member.profile', compact('member'));
    }

    public function edit()
    {
        $member = Auth::guard('member')->user();
        return view('member.edit', compact('member'));
    }

   public function update(Request $request)
{
    $member = Auth::guard('member')->user();

    $request->validate([
        'name' => 'required',
        'phone' => 'required',
        'gender' => 'nullable',
        'birth_date' => 'nullable|date',
        'profile_image' => 'nullable|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Update data umum
    $member->name = $request->name;
    $member->phone = $request->phone;
    $member->gender = $request->gender;
    $member->birth_date = $request->birth_date;

    // Upload dan simpan profile_image jika ada
    if ($request->hasFile('profile_image')) {
        $filename = time() . '.' . $request->file('profile_image')->extension();
        $request->file('profile_image')->move(public_path('profiles'), $filename);
        $member->profile_image = $filename;
    }

    $member->save();

    return redirect()->route('member.profile')->with('success', 'Profil berhasil diperbarui.');
}
    public function logout(Request $request)
{
    Auth::guard('member')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
}
}
