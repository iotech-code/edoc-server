<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'schools';

    protected $fillable = [
        'code',
        'name'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function cabinets() {
        return $this->hasMany(Cabinet::class);
    }
}
