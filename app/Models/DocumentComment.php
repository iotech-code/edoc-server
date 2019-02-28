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

    protected $appends = [
        'thai_date'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function author() {
        return $this->belongsTo(User::class, 'author_id');
    }

    // return thai date format 
    public function getThaiDateAttribute() {
        return dateToFullDateThai(date("d/m/Y", strtotime("{$this->attributes['created_at']}"))) ;
    }

    // return thai date format 
    public function getCreatedThaiFormatAttribute() {
        $full_split = explode(" ", $this->attributes['created_at']);
        $date = date("d/m/Y", strtotime($full_split[0]));
        return dateToFullDateThai($date)." ".$full_split[1];
    }

    public function attachments(){
        return $this->hasMany(DocumentCommentAttachment::class, 'comment_id');
    }
}
