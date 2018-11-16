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
            $q->with(['attachments', 'author'])->orderBy('created_at', 'desc');
        }])->find($id);

        $addition = [
            'accept_able' => $documentModel->acceptAbleByUser($user->id),
            'approve_able' => $documentModel->approvAbleByUser($user->id)
        ];

        if( $documentModel != null && $documentModel->school_id == $user->school_id ) {
            // return response()->json( $documentModel);
            return response()->json( array_merge($documentModel->toArray(), $addition) );

        } else {
            return response()->json(['message' => 'ไม่พบข้อมูลที่ท่านต้องการ'], 404);
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
            $commentModel = $documnet->comments()->create([
                'author_id' => $user->id,
                'comment' => $request->comment
            ]);

            if ( $request->hasFile('files') ) {
                foreach($request->file('files') as $file){
                    // return $file;
                    $commentModel->attachments()->create([
                        'name' => $file->getClientOriginalName(),
                        'file_path' => $file->store("comment/{$commentModel->id}")
                    ]);
                }
            }
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
            if ($document->reply_type_id == 1 && $request->action == 'accept') {
                $user->accessibleDocuments()->updateExistingPivot($document->id, ["is_read" => 1]);
                if ( $document->accessibleUsers()->wherePivot('is_read', 0)->count() == 0 ) {
                    $document->update([
                        'status' => 3 
                    ]);
                }
                return response()->json(["message" => "ดำเนินการสำเร็จ"]);
            } else if( $document->reply_type_id == 2 && in_array($request->action, ["approve", "unapprove"])) {
                $document->update([
                    'status' => $request->action == "approve" ? 3: 4
                ]);
                return response()->json(["message" => "ดำเนินการสำเร็จ"]);
            } else {
                return reponse()->json([
                    'status' => false
                ], 404);
            }
        }
    }
}
