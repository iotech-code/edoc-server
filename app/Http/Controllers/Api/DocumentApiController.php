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
     * get refer documenet by search 
     */
    public function getReferDocument(Request $request) {

    }

    /**
     * get document my auth user
     */
    public function getDocuments() {
        $documents = Document::where('school_id', Auth::user()->school_id);
        return $documents->paginate(10);
    }
}
