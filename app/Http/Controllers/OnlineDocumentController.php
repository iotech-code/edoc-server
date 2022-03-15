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
        $data = ['status' => 'success', 'id' => $onlinedocument->id];
        return response()->json($data, 200);
    }

    public function delete($id) {
        // return response()->json($request);
        $deletefile = OnlineDocument::where('id', $id)->where('is_lock', '<>', '1')->delete();
        if($deletefile) {
            Storage::disk('public')->delete('online_document/'.$id.'.html');
            $data = ['status' => 'success'];
            return response()->json($data, 200);
        } else {
            $data = ['status' => 'error'];
            return response()->json($data, 200);
        }

    }

    public function update(Request $request) {
 
        OnlineDocument::where('id', $request->_id)->update([
            'doc_title' => $request->_title,
            'doc_body' => $request->_body
        ]);

        $template = file_get_contents(storage_path('online_document_template.html'));
        $template = str_replace('{title}', $request->_title, $template);
        $template = str_replace('{body}', $request->_body, $template);

        Storage::disk('public')->put('online_document/'.$request->_id.'.html', $template);

        // $statuses = DocumentStatus::all();
        $data = ['status' => 'success', 'id' => $request->_id];
        return response()->json($data, 200);
    }

    public function documentList(Request $request) {
        $user = auth()->user();
        $list = OnlineDocument::select('id','doc_title')->where("uid", $user->id)->get();
        return response()->json($list);
    }

    public function editor(Request $request) {
        $title = 'เอกสารไม่มีชื่อ';
        $content = '';
        $id = '';
        $status = 'เอกสารใหม่';
        if(isset($request->edit)) {
            $data = OnlineDocument::where("id", $request->edit)->first();
    
            $title = $data->doc_title;
            $content = $data->doc_body;
            $status = 'แก้ไขเอกสารเดิม';
            $id = $data->id;
        }

        return view('editor')->with(compact([
            'content', 'title', 'status', 'id'
        ]));
    }
}
