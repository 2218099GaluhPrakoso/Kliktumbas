<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model {
    protected $fillable = ['name','description','image'];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function ratings() {
        return $this->hasMany(UmkmRating::class);
    }

    public function averageRating() {
        return round($this->ratings()->avg('rating'),1) ?? 0;
    }
}



