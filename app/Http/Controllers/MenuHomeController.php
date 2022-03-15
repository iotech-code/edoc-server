<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\User;
use App\Models\Line;
use App\Models\Cabinet;

class MenuHomeController extends Controller
{
    protected $documentQunatity ;

    protected $documentQuantityEachCabinet ;

    protected $documentType;

    public function index()
    {
        $user = auth()->user();
        $local_cabinets_object = $user->cabinetPermissions()->withCount('documents')->get();
        $local_cabinets = $user->cabinetPermissions;
        $local_cabinets_count = $local_cabinets_object->pluck(['documents_count']);

        $document_type_list = DocumentType::orderBy('id')->get()->pluck(['name']);
        $document_type_query = $document_type_count = DocumentType::with(['documents'=>function($query) use($user) {
                $query->where('school_id', $user->school_id);
            }])->get();
        $document_type_count = collect();
        foreach ($document_type_query as $type) {
            $document_type_count->push($type->documents->count());
        }
        $documents = Document::where('school_id', $user->school_id)
            ->orderBy('created_at')->take(5)->get();

        $cabinets_count = Cabinet::where('school_id', $user->school_id)->count();


        $documents_count_admin =  Document::where('school_id', $user->school_id)->count(); 

        $documents_status1_admin = Document::where('school_id', $user->school_id)->where('status','=','1')->count();

        $documents_status2_admin = Document::where('school_id', $user->school_id)->where('status','=','2')->count();

        $documents_status3_admin = Document::where('school_id', $user->school_id)->where('status','=','3')->count();

        $documents_status4_admin = Document::where('school_id', $user->school_id)->where('status','=','4')->count();


        
        $documents_count = $user->accessibleDocuments() ->count();

        $documents_status1 =  $user->accessibleDocuments()->where('status','=','1')->count(); //แบบร่าง

        $documents_status2 = $user->accessibleDocuments()->where('status','=','2')->count(); //ดำเนินการ

        $documents_status3 = $user->accessibleDocuments()->where('status','=','3')->count(); //เสร็จสิ้น

        $documents_status4 = $user->accessibleDocuments()->where('status','=','4')->count(); //ไม่อนุมัติ

        $users = User::where('school_id', $user->school_id)->count();
        $line = Line::where('uid', $user->id)->get();
        return view('menuhome', compact([
            'documents',
            'local_cabinets',
            'local_cabinets_count',
            'document_type_list',
            'document_type_count',
            'local_cabinets_object',
            'users',
            'line',
            'documents_count',
            'cabinets_count',
            'documents_status1',
            'documents_status2',
            'documents_status3',
            'documents_status4',
            'documents_count_admin',
            'documents_status1_admin',
            'documents_status2_admin',
            'documents_status3_admin',
            'documents_status4_admin'

        ]));
        // return view('index');
    }
}