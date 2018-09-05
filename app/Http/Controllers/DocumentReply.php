<?php

namespace App\Http\Controllers ;

use App\Models\Document ;

trait DocumentReply {
    

    public function createReply(Document $document, Request $requset) {
        $reply_doc = Document::create([

        ]);
    }
}