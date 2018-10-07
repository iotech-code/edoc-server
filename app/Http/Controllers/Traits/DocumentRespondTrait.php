<?php

namespace App\Http\Controllers\Traits ;

use App\Models\Document ;

use Illuminate\Http\Request;

trait DocumentRespondTrait {
    

    public function respond($id, Request $request) {
        // if not approve able 
        // return $request->all();
        $documentModel = Document::findOrFail($id);
        $user = auth()->user();
        if( $documentModel->approve_able && $documentModel->approved_user_id == $user->id ) {
            return $this->approve($documentModel, $request);
        } elseif ( !$documentModel->approve_able ) {
            return $this->approve($documentModel, $request);
        } else {
            abort(404);
            // return redirect()->route('document')
            // return redirect()->route('document.show', $documentModel->id);
        }
    }

    public function approve(Document $documentModel, Request $request) {
        $user = auth()->user();
        // $user->accessibleDocuments()->updateExistingPivot($documentModel->id,[
        //    'is_read' => 1 
        // ]);
        $status = $request->is_approve == 1 ? 3 : 4;
        $documentModel->update(['status' => $status]);
        return redirect()->route('document.show', $documentModel->id);
    }

    public function accept(Document $documentModel, Request $request) {
        // $documentModel->user
        $user = auth()->user();
        $user->accessibleDocuments()->updateExistingPivot($documentModel->id,[
           'is_read' => 1 
        ]);
        return redirect()->route('document.show', $documentModel->id);
    }
    
}