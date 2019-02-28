<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SharingDocument extends Model
{

    protected $fillable = [
        'token'
    ];
    
    public function document() {
        return $this->belongsTo(Document::class);
    }
}
    