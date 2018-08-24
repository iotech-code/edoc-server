<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{
    /**
     * 
     */
    protected $table = 'cabinets';

    /**
     * 
     */
    protected $fillable = [
        'name',
        'desription'
    ];

    /** 
     * @return App\Models\Document
     */
    public function documents() {
        return $this->hasMany(Document::class);
    }
}
