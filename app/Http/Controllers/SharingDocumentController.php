<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SharingDocument;

class SharingDocumentController extends Controller
{

    public function show($token) {
        $document = SharingDocument::where('token', $token)->first()->document;
        return view('document-sharing.show', compact(
            'document'
        ));
    }
}
