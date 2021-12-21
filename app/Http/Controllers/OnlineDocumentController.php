<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OnlineDocument; 

use Auth ;

class OnlineDocumentController extends Controller
{
    public function __construct() {
    }
    //
    public function create(Request $request)
    {
        // return response()->json($request, 200) ;
        $user = auth()->user();
        $onlinedocument = OnlineDocument::create([
            'uid' => $user->id,
            'doc_title' => $request->_title,
            'doc_body' => $request->_body,
            'is_lock' => 0
        ]);

        // $statuses = DocumentStatus::all();
        $data = ['status' => 'success', 'body' => $request];
        return response()->json($data, 200) ;
    }
}
