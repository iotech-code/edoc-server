<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OnlineDocument; 
use Illuminate\Support\Facades\Storage;

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

        $template = file_get_contents(storage_path('online_document_template.html'));
        $template = str_replace('{title}', $request->_title, $template);
        $template = str_replace('{body}', $request->_body, $template);

        Storage::disk('public')->put('online_document/'.$onlinedocument->id.'.html', $template);

        // $statuses = DocumentStatus::all();
        $data = ['status' => 'success', 'body' => $request];
        return response()->json($data, 200) ;
    }
}
