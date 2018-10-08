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
}
