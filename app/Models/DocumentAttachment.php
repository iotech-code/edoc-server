<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentAttachment extends Model
{
    /**
     * 
     */
    protected $table = 'document_attachments';

    /**
     * 
     */
    protected $fillable = [
        'file_path',
        'name'
    ];

    public function getLinkAttribute() {
        return route("attachment.download", $this->id);
    }


}
