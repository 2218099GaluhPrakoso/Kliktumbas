<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class ProfileController extends Controller
{
    public function index()
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
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $member->name = $request->name;
        $member->phone = $request->phone;

        if ($request->hasFile('profile_image')) {
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/members'), $imageName);
            $member->profile_image = $imageName;
        }

        $member->save();

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
