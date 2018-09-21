<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'documents' ;

    protected $fillable = [
        'title',
        // 'from',
        'code',
        // 'refer',
        'date',
        'receive_code',
        'receive_date',
        // 'receive_achives',
        'keywords',
        'send_to_cabinet_id',
        'cabinet_id',
        'folder_id',
        'read_at',
        'user_id',
        'school_id',
        'type_id',
        'heading',
        'status',
        'remark',
        'reply_type'
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
        return $this->belongsTo(Cabinet::class, 'cabinet_id');
    }

    /**
     * relation 
     * 
     * @return App\Models\Cabinet
     */
    public function sendToCabinet() {
        return $this->belongsTo(Cabinet::class, 'send_to_cabinet_id');
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

    public function getStatusTextAttribute() {
        switch ($this->attributes['status']) {
            case 1:
                // daft
                $text = 'แบบร่าง';
                break;
            case 2:
                //waiting
                $text = 'กำลังดำเนินการ';
                break; 
            case 3:
                //approve
                $text = 'อนุมัติ/รับทราบ';
                break; 
            case 4:
                //unapprove
                $text = 'ไม่อนุมัติ';
                break; 
            default:
                $text = 'แบบร่าง';
                break;
        }
        return $text;
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
    public function folder() {
        return $this->belongsTo(Folder::class);
    }   
    
    /**
     * 
     */
    public function references() {
        return $this->belongsTomany(Document::class, 'document_references', 'doc_id', 'refer_id');
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

    /**
     * @return Collection $list of Document
     */
    public function scopeOfCabinets($query, array $cabibets) {
        if (count($cabibets) < 1) {
            return $query;
        }
        $query->where('cabinet_id', $cabibets[0]); 
        foreach ( array_slice($cabibets, 1) as $c_id) {
            $query->orWhere("cabinet_id", $c_id);
        }
        return $query ;
    }

    public function getLinkAttribute(){
        return route("document.edit", $this->id) ;
    }

    public function getBeDateAttribute() {
        return date("d/m/Y", strtotime("{$this->attributes['date']} +543 years")) ;
    }

    public function documentAssigns() {
        return $this->belongsToMany(User::class, 'document_assignments', 'document_id', 'user_id');
    }

    public function replyType(){
        return $this->belongsTo(DocumentReplyType::class, 'reply_type');
    }

    /**
     * @return Collection $list of Document
     */
    public function scopeOfById($query, array $list) {
        if (count($list) < 1) {
            return $query;
        }
        // $query->where('id', $list[0]); 
        foreach ( array_slice($list, 1) as $id) {
            $query->orWhere("id", $id);
        }
        return $query ;
    }

    public function canAccess($user_id) {
        return $this->documentAssigns()->wherePivot('user_id', $user_id)->count();
    }
}
