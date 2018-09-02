<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    protected $table = 'folders';

    protected $fillable = [
        'name',
        'description',
        'school_id',
        'cabinet_id',
    ];

    /**
     * 
     */
    public function cabinet() {
        return $this->belongsTo(Cabinet::class) ;
    }

    /**
     * 
     */
    public function documents() {
        return $this->hasMany(Document::class) ;
    }
}
