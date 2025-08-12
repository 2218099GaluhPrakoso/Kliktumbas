<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use Illuminate\Support\Facades\DB;
class UmkmController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat'       => 'nullable|string|max:20',
            'telepon'     => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

       if ($request->hasFile('image')) {
    $file = $request->file('image');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('umkm_images'), $filename);
    $data['image'] = 'umkm_images/' . $filename;
}

        Umkm::create($data);

        return back()->with('success', 'UMKM berhasil ditambahkan.');
    }
public function update(Request $request, $id)
{
    $umkm = Umkm::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'telepon' => 'nullable|string|max:20',
        'alamat' => 'nullable|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $umkm->name = $request->name;
    $umkm->description = $request->description;
    $umkm->telepon = $request->telepon;
    $umkm->alamat = $request->alamat;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('umkm_images'), $filename);
        $umkm->image = 'umkm_images/' . $filename;
    }

    $umkm->save();

    return redirect()->back()->with('success', 'UMKM berhasil diperbarui');
}



public function all() {
    return Umkm::select('id','name','logo')
        ->withAvg('ratings', 'rating')
        ->get()
        ->map(function($item){
            $item->rating = number_format($item->ratings_avg_rating, 1);
            return $item;
        });
}

public function index()
{
    $umkms = Umkm::leftJoin('umkm_ratings', 'umkms.id', '=', 'umkm_ratings.umkm_id')
    ->select(
        'umkms.id',
        'umkms.name',
        'umkms.description',
        'umkms.image',
        DB::raw('COALESCE(AVG(umkm_ratings.rating), 0) as rating'),
        DB::raw('COUNT(umkm_ratings.id) as review_count')
    )
    ->groupBy('umkms.id', 'umkms.name', 'umkms.description', 'umkms.image')
    ->get();

    return view('umkm.index', compact('umkms'));
}


public function destroy($id)
{
    $umkm = Umkm::findOrFail($id);

    
    if ($umkm->image && file_exists(storage_path('app/public/' . $umkm->image))) {
        unlink(storage_path('app/public/' . $umkm->image));
    }

    
    $umkm->delete();

    return redirect()->back()->with('success', 'UMKM berhasil dihapus.');
}

public function profile($id)
{
    $umkm = Umkm::with('ratings', 'products.ratings')->findOrFail($id);

    
    $umkmAvg = number_format($umkm->ratings->avg('rating') ?? 0, 1);

    
    $products = $umkm->products;

    return view('umkm.profile', compact('umkm', 'umkmAvg', 'products'));
}


public function products($id)
{
    $umkm = Umkm::findOrFail($id);
    $products = $umkm->products()->with('ratings')->get();
    return view('umkm.products', compact('umkm', 'products'));
}


}
