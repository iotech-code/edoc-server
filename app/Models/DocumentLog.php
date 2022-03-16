<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentLog extends Model
{
    protected $table = 'document_log';
    //
    protected $fillable = [
        'document_id',
        'action'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
