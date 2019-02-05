<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCommentAttachment extends Model
{
    protected $table = 'document_comment_attachments';

    protected $fillable = [
        'file_path',
        'name'
    ];
    
    protected $hidden = [
        'created_at', 'updated_at'
    ];

    protected $appends = [
        'link'
    ];

    public function getLinkAttribute() {
        return route("attachment.download", ["comment",$this->id]);
    }

}
