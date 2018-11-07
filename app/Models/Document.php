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
        // 'heading',
        'status',
        'remark',
        'reply_type_id',
        'approved_user_id'
    ];

    protected $appends = [
        'thai_date',
        // 'approve_able'
        // 'document_type_text',
        // 'reply_type_text'
    ];

    protected $with = [
        'fromCabinet'
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

    public function sendFormCabinet() {
        return $this->belongsTo(Cabinet::class, 'cabinet_id');
    }

    public function comments() {
        return $this->hasMany(DocumentComment::class, 'document_id');
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
                // $text = 'กำลังดำเนินการ';
                $text = 'ดำเนินการ';
                break; 
            case 3:
                //approve
                // $text = 'อนุมัติ/รับทราบ';
                $text = 'สำเร็จ';
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

    public function getRenderStatusTagAttribute() {
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
            case 5:
                //unapprove
                $color = 'black';
                break; 
            default:
                $color = 'grey';
                break;
        }
        $html = "<span class=\"status-tag status-${color}\" >$this->status_text</span>";
        return $html;
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
        if( $data['cabinet_id'] != null) {
            $q->orWhere('cabinet_id', $data['cabinet_id']);
            $q->orWhere('send_to_cabinet_id', $data['cabinet_id']);
        } 
        if( isset($data['document_types']) && $data['document_types'] != null) {
            $q->whereIn('type_id', $data['document_types']);
        }
        if( isset($data['statuses']) && $data['statuses'] != null) {
            $q->whereIn('status', $data['statuses']);
        }
        return $q ;
    }

    /**
     * @return Builder $list of Document
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
        return route("document.show", $this->id) ;
    }

    public function getThaiDateAttribute() {
        return dateToFullDateThai(date("d/m/Y", strtotime("{$this->attributes['date']}"))) ;

    }

    public function documentAssigns() {
        return $this->belongsToMany(User::class, 'document_assignments', 'document_id', 'user_id');
    }

    public function replyType(){
        return $this->belongsTo(DocumentReplyType::class, 'reply_type_id');
    }


    public function accessibleUsers() {
        return $this->belongsToMany(User::class, 'documents_users', 'document_id', 'user_id')
            ->withPivot(['is_read', 'document_user_status']);
    }

    public function getDocumentTypeTextAttribute() {
        return $this->type->name;
    }

    public function getReplyTypeTextAttribute() {
        return $this->replyType->name;
    }

    public function fromCabinet() {
        return $this->belongsTo(Cabinet::class, 'cabinet_id');
    }

    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function acceptAbleByUser($user_id) {
        $user = $this->accessibleUsers()->find($user_id);
        return $this->attributes['reply_type_id'] == 1 
            && $this->attributes['status'] == 2 
            && $user 
            && !$user->pivot->is_read;
    }   

    public function approvAbleByUser($user_id) {
        $approve_user = $this->attributes['approved_user_id'];
        return $this->attributes['reply_type_id'] == 2
            && $this->attributes['status'] == 2
            && $user_id == $approve_user;
    }


}
