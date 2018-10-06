<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Document; 

use Auth ;

class DocumentApiController extends BaseApiController
{

    public function __construct() {
    }

    /**
     * get document my auth user
     */
    public function getDocuments() {
        $documents = Document::where('school_id', Auth::user()->school_id);
        return $documents->paginate(10);
    }

    public function getDocumentById($id){
        $documentModel = Document::find($id) ;
        
        if( $documentModel != null && $documentModel->school_id == auth()->user()->school_id ) {
            return response()->json($documentModel);
        } else {
            return response()->json(['message' => 'ไม่พบข้อมูลที่ท่านต้องการ'], 403);
        }
    }

    public function forwordDocument($id){

    }

    public function commentDocument($id){
        
    }
}
