<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Document; 

use Auth ;
use Validator;
class DocumentApiController extends BaseApiController
{

    public function __construct() {
    }

    /**
     * get document my auth user
     */
    public function getDocuments(Request $request) {
        $user = auth()->user();
        $documents = Document::with(['fromCabinet'])->where('school_id', $user->school_id);
        if (!is_null($request->text)) {
            $documents->where('title', 'like', "%{$request->text}%");
            $documents = $documents->paginate(10);
            $documents->withPath(route('api.document.list', ['text'=>$request->text]));
            return response()->json($documents);
            
            // $documents->appends(['text'=>$request->text]);
        }
        return $documents->paginate(10);
    }

    public function getDocumentById($id){
        $user = auth()->user();
        $documentModel = Document::with(['type', 'attachments','replyType', 'creator', 'fromCabinet', 'comments'=> function($q){
            $q->with(['attachments', 'author']);
        }])->find($id);
        // $documentModel = $

        if( $documentModel != null && $documentModel->school_id == $user->school_id ) {
            return response()->json($documentModel);
        } else {
            return response()->json(['message' => 'ไม่พบข้อมูลที่ท่านต้องการ'], 403);
        }
    }

    public function comment($id, Request $request) {
        $user = auth()->user();
        $documnet = Document::where('school_id', $user->school_id)->find($id);

        if( !$documnet ) {
            return response()->json([
                'message' => 'มีบางอย่างไม่ถูกต้อง',
            ], 404); 
        }
        $validator = Validator::make($request->all(),[
            'comment' => 'required',
            // 'action' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        } else {
            $documnet->comments()->create([
                'author_id' => $user->id,
                'comment' => $request->comment
            ]);
            return response()->json(["message" => "ดำเนินการสำเร็จ"]);
        }

    }

    public function respond($id, Request $request) {
        // return $request->all();
        $user = auth()->user();
        $document = Document::where('school_id', $user->school_id)->find($id);

        if( !$document ) {
            return response()->json([
                'message' => 'มีบางอย่างไม่ถูกต้อง',
            ], 404); 
        }

        $validator = Validator::make($request->all(),[
            // 'comment' => 'required',
            'action' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()], 403);
        } else {
            if ($document->reply_type == 1 && $request->action == 'accept') {
                $user->accessibleDocuments()->updateExistingPivot($document->id, ["is_read" => 1]);
                if ( $document->accessibleUsers()->wherePivot('is_read', 0)->count() == 0 ) {
                    $document->update([
                        'status' => 3 
                    ]);
                }
                return response()->json(["message" => "ดำเนินการสำเร็จ"]);
            }
        }
    }
}
