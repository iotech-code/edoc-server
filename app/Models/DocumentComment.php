<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentComment extends Model
{
    protected $table = "document_comments" ;

    protected $fillable = [
        'author_id',
        'comment',
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function getCreatedThaiFormatAttribute() {
        $full_split = explode(" ", $this->attributes['created_at']);
        $date = date("d/m/Y", strtotime($full_split[0]));
        return dateToFullDateThai($date)." ".$full_split[1];
    }
}
