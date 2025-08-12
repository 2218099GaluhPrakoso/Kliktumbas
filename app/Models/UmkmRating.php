<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UmkmRating extends Model {
    protected $fillable = ['umkm_id','member_id','rating'];

    public function umkm() {
        return $this->belongsTo(Umkm::class);
    }
}

