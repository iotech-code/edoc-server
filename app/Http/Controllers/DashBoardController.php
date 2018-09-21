<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
class DashBoardController extends Controller
{
    protected $documentQunatity ;

    protected $documentQuantityEachCabinet ;

    protected $documentType;

    public function index() {
        $documents = Document::where('school_id', auth()->user()->school_id)
            ->orderBy('created_at')->take(5)->get();
        return view('dashboard', compact([
            'documents'
        ]));
    }

}
