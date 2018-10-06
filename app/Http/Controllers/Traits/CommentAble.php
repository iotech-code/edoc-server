<?php

namespace App\Http\Controllers\Traits ;

use App\Models\Document ;

use Illuminate\Http\Request;

trait CommentAble {
    

    public function comment($id, Request $request) {

        $user = auth()->user() ;
        $document = Document::find($id);
        $commentModel = $document->comments()->create([
            'author_id' => $user->id,
            'comment' => $request->comment,
        ]);

        $user->accessibleDocuments()->updateExistingPivot($document->id, [
            'is_read' => 1,
            'document_user_status' => 2
        ]);
        // update to inbox 
        
        if ($document->accessibleUsers->where('id', $request->receivers)->count()) {
            $document->accessibleUsers()->updateExistingPivot($request->receivers, [
                'document_user_status' => 1,
                ]);
                
            } else {
            $document->accessibleUsers()->attach($request->receivers, [
                'document_user_status' => 1,
            ]);
        }

        if ( $request->file('files') ) {
            foreach($request->file('files') as $file){
                $documentModel->attachments()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $file->store("document/{$documentModel->id}")
                ]);
            }
        }

        return redirect()->route('document.index');
        
    }
}