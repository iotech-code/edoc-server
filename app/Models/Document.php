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
        'read_at',
        'user_id',
        'school_id',
        'type_id'
    ];

    /**
     * relation
     * 
     * @return App\Models\DocumentAttachment
     */
    public function attachments() {
        return $this->hasMany(DocumentAttachment::class);
    }

    /**
     * relation 
     * 
     * @return App\Models\Cabinet
     */
    public function cabinet() {
        return $this->belongsTo(Cabinet::class);
    }

    /**
     * relation 
     * 
     * @return App\Models\Cabinet
     */
    public function type() {
        return $this->belongsTo(DocumentType::class, 'type_id');
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

    /**
     * 
     */
    public function scopeOfSearch($q, array $data) {
        
        if( $data['title'] != null ) {
            $q->where('title', 'like' ,"%{$data['title']}%");
        } 
        if($data['date_start'] != null ) {
            $q->where('created_at', '>=', $data['date_start']);
        }
        if( $data['date_end'] != null ) {
            $q->where('created_at', '<=', $data['date_end']);
        }
        return $q ;
    }

}
