<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    public function index()
    {
        $umkms = Umkm::with('products')->get();
        return view('admin.umkm.index', compact('umkms'));
    }

    public function create()
    {
        return view('admin.umkm.create');
    }

   public function store(Request $request)
{
    $data = $request->validate([
        'name'        => 'required',
        'description' => 'nullable',
        'alamat'       => 'nullable|string|max:20',
        'telepon'     => 'nullable|string|max:255',
        'image'       => 'nullable|image'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('umkm_images', 'public');
    }

    Umkm::create($data);
    return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil ditambahkan.');
}

public function update(Request $request, Umkm $umkm)
{
    $data = $request->validate([
        'name'        => 'required',
        'description' => 'nullable',
        'phone'       => 'nullable|string|max:20',
        'address'     => 'nullable|string|max:255',
        'image'       => 'nullable|image'
    ]);

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('umkm_images', 'public');
    }

    $umkm->update($data);
    return redirect()->route('admin.umkm.index')->with('success', 'UMKM berhasil diperbarui.');
}


    public function destroy(Umkm $umkm)
    {
        $umkm->delete();
        return back()->with('success', 'UMKM berhasil dihapus.');
    }
}
