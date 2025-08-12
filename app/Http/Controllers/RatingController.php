<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UmkmRating;
use App\Models\ProductRating;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id'     => 'required|integer',
            'type'   => 'required|string|in:umkm,product',
            'rating' => 'required|integer|min:1|max:5',
            'comment'=> 'nullable|string|max:1000',
        ]);

        $memberId = Auth::guard('member')->id();
        if (!$memberId) {
            return response()->json([
                'success' => false,
                'message' => 'Silahkan login terlebih dahulu.'
            ], 401);
        }

        if ($request->type === 'umkm') {
            UmkmRating::updateOrCreate(
                ['umkm_id' => $request->id, 'member_id' => $memberId],
                ['rating' => $request->rating, 'comment' => $request->comment]
            );
        } else {
            ProductRating::updateOrCreate(
                ['product_id' => $request->id, 'member_id' => $memberId],
                ['rating' => $request->rating, 'comment' => $request->comment]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Rating berhasil disimpan.'
        ]);
    }
}
