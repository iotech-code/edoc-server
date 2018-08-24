<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents' ;

    protected $fillable = [
        'title',
        'from',
        'code',
        'refer',
        'date',
        'receive_code',
        'receive_date',
        'receive_achives',
        'keywords',
        'cabinet_id',
        'read_at'
    ];

    /**
     * @return App\Models\DocumentAttachment
     */
    public function attachments() {
        return $this->hasMany(DocumentAttachment::class);
    }


    public function cabinet() {
        return $this->belongsTo(Cabinet::class);
    }

    /**
     * ovveride set keywords method
     * @param mixed $value 
     */
    public function setKeywordsAttribute($value) {
        if ( is_array($value) ) {
            $this->attributes['keywords'] = implode(" ", $value);
        } else {
            $this->attributes['keywords'] = $value ;
        }
    }

    /**
     * cast to render html 
     * 
     * @return string $html
     */
    public function getRenderStatusAttribute() {
        switch ($this->attributes['status']) {
            case 1:
                // daft
                $color = 'grey';
                break;
            case 2:
                //waiting

                $color = 'yellow';
                break; 
            case 3:
                //approve

                $color = 'green';
                break; 
            case 4:
                //unapprove

                $color = 'red';
                break; 
            default:
                $color = 'grey';
                break;
        }
        $html = "<span class=\"status-circle status-${color}\" ></span>";
        return $html;
    }


}
