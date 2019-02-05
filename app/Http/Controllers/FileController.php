<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentAttachment ; 
use App\Models\DocumentCommentAttachment ; 

class FileController extends Controller 
{
    public function downloadFile($prefix, $token){
        if($prefix == "document") {
            $model = DocumentAttachment::find($token);

        } elseif( $prefix == "comment" ) {
            $model = DocumentCommentAttachment::find($token);
        } else {
            return response()->json("มีบางอย่างผิดพลาด", 404);
        }
        $path = "app/$model->file_path" ;
        return response()->download(
            storage_path($path),
            $model->name
        );
    }
}
