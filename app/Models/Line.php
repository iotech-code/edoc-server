<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    //
    protected $table = 'user_line_token';
    protected $primaryKey = 'id';
    protected $fillable = ['uid', 'line_token'];
}
