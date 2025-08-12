<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['umkm_id','name','description','price','image','category'];


    public function umkm() {
        return $this->belongsTo(Umkm::class);
    }

    public function ratings() {
        return $this->hasMany(ProductRating::class);
    }

    public function averageRating() {
        return round($this->ratings()->avg('rating'),1) ?? 0;
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
