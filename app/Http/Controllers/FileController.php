<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DocumentAttachment ; 

class FileController extends Controller
{
    public function downloadFile($token){
        $model = DocumentAttachment::find($token);
        $path = "app/".$model->file_path ;
        return response()->download(
            storage_path($path),
            $model->name
        );
    }
}
