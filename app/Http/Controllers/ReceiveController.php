<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentStatus;
use App\Models\Folder;
use App\Models\Cabinet;
use App\Models\User;
use App\Models\DocumentType;

use PDF;


use App\Http\Controllers\Traits\DocumentCommentTrait ;
use App\Http\Controllers\Traits\DocumentRespondTrait ;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\PublishDocument;

use Validator;

class ReceiveController extends Controller
{
    public function index(Request $request)
    {
        $title = $date_start = $date_end = "";
        $user = auth()->user();
        $cabinets = $user->cabinetPermissions()->get();
        $folders = Folder::where('school_id', $user->school_id)->get();
        $documents_all = Document::where('school_id', $user->school_id)->get();
        // $documents = $user->accessibleDocuments()->where('school_id', $user->school_id)->where('document_user_status','=','1')->whereNull('receive_code');
        $documents = Document::where('school_id', $user->school_id)->whereNull('receive_code');
        // $documents = $user->accessibleDocuments()->where('document_user_status','=','1')->where('is_read','=','0')->whereNull('receive_code');
        
        $old = null;
        

        $document_types = DocumentType::all();

        $access_document = $user->accessibleDocuments()->get()->pluck(['id']);

        if (isset($request->search)) {
            $documents = $documents->ofSearch($request->search);
            $old = array_merge($request->search);
        }

        $documents = $documents->orderBy('created_at', 'desc')->paginate(15);


        return view('receives/index')
            ->with(compact([
                'documents',
                'user',
                'title',
                'date_start',
                'date_end',
                // 'code',
                'cabinets',
                'folders',
                // 'tab_active',
                'document_types',
                'old',
                'access_document'
                // 'unreadDocuments'
            ]));
    }

    public function received(Request $request)
    {
        $title = $date_start = $date_end = "";
        $user = auth()->user();
        $cabinets = $user->cabinetPermissions()->get();
        $folders = Folder::where('school_id', $user->school_id)->get();
        $documents = Document::where('school_id', $user->school_id)->whereNotNull('receive_code');
        $old = null;
        

        $document_types = DocumentType::all();

        $access_document = $user->accessibleDocuments()->get()->pluck(['id']);
        
        if (isset($request->search)) {
            $documents = $documents->ofSearch($request->search);
            $old = array_merge($request->search);    
        } 

        $documents = $documents->orderBy('created_at', 'desc')->paginate(15); 

            return view('receives/received')
            ->with(compact([
                'documents',
                'user',
                'title',
                'date_start',
                'date_end',
                // 'code',
                'cabinets',
                'folders',
                // 'tab_active',
                'document_types',
                'old',
                'access_document'
                // 'unreadDocuments'
            ]));   
    }

    public function export(Request $request)
    {
        $title = $date_start = $date_end = "";
        $user = auth()->user();
        $cabinets = $user->cabinetPermissions()->get();
        $folders = Folder::where('school_id', $user->school_id)->get();
        $documents = Document::where('school_id', $user->school_id)->whereNotNull('receive_code');
        $old = null;
        

        $document_types = DocumentType::all();

        $access_document = $user->accessibleDocuments()->get()->pluck(['id']);
        
        if (isset($request->search)) {
            $documents = $documents->ofSearch($request->search);
            $old = array_merge($request->search);    
        } 

        $documents = $documents->orderBy('created_at', 'desc')->paginate(15); 

            return view('receives/export')
            ->with(compact([
                'documents',
                'user',
                'title',
                'date_start',
                'date_end',
                // 'code',
                'cabinets',
                'folders',
                // 'tab_active',
                'document_types',
                'old',
                'access_document'
                // 'unreadDocuments'
            ]));   
    }


    public function pdf(Request $request)
    {
        $title = $date_start = $date_end = "";
        $user = auth()->user();
        $cabinets = $user->cabinetPermissions()->get();
        $folders = Folder::where('school_id', $user->school_id)->get();
        $documents = Document::where('school_id', $user->school_id)->whereNotNull('receive_code');
        $old = null;
        

        $document_types = DocumentType::all();

        $access_document = $user->accessibleDocuments()->get()->pluck(['id']);

        if (isset($request->search)) {  
            $documents = $documents->ofSearch($request->search);
            $old = array_merge($request->search);
        }

        $documents = $documents->orderBy('created_at', 'desc')->paginate(100);

        // $pdf = \App::make('dompdf.wrapper');
        $pdf = PDF::loadView('receives/pdf',['documents' => $documents]);
        $pdf->setPaper('A3', 'landscape');
        return $pdf->stream('export.pdf');
    }
}

