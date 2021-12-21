<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OnlineDocument extends Model
{
    protected $table = 'online_document';
    //
    protected $fillable = [
        'uid',
        'doc_title',
        'doc_body',
        'is_lock'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
