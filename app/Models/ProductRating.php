<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class ProductRating extends Model {
    protected $fillable = ['product_id','member_id','rating'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

