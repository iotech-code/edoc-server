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
        'description',
        'school_id'
    ];

    /** 
     * @return App\Models\Document
     */
    public function documents() {
        return $this->hasMany(Document::class);
    }

    /** 
     * @return App\Models\Folder
     */
    public function folders() {
        return $this->hasMany(Folder::class);
    }

    /** 
     * @return App\Models\User
     */
    public function permissions() {
        return $this->belongsToMany(User::class, 'user_cabinet_permission', 'cabinet_id', 'user_id');
    }
}
