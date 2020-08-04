<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = "document_types";

    public function documents() {
        return $this->hasMany(Document::class, 'type_id');
    }
}
