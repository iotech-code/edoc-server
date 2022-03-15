<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentStatus;
use App\Models\Folder;
use App\Models\Cabinet;
use App\Models\User;
use App\Models\DocumentType;
use App\Models\OnlineDocument; 
use App\Http\Controllers\Traits\DocumentCommentTrait ;
use App\Http\Controllers\Traits\DocumentRespondTrait ;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use App\Mail\PublishDocument;

use Validator;

class DocumentController extends Controller
{

    use DocumentRespondTrait,
        DocumentCommentTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // render data
        $title = $date_start = $date_end = "";
        $user = auth()->user();
        $cabinets = $user->cabinetPermissions()->get();
        $folders = Folder::where('school_id', $user->school_id)->get();
        $documents = Document::where('school_id', $user->school_id);
        $document_types = DocumentType::all();

        $tab_active = isset($request->t)? $request->t : "all";
        $old = null;
        $current_active_tab = $this->getActiveTabToId($tab_active);

        if( !is_null($current_active_tab)) {
            $access_document = $user->accessibleDocuments()->wherePivot('document_user_status', $current_active_tab)->get()->pluck(['id']);
            $documents->whereIn('id', $access_document);
        } else {
            $access_cabinet_list = $user->cabinetPermissions()->get()->pluck(['id']);
            // if ($request->search['document'])
            $access_document = $user->accessibleDocuments()->get()->pluck(['id']);
            $documents->whereIn('cabinet_id', $access_cabinet_list);
            $documents->whereIn('send_to_cabinet_id', $access_cabinet_list, 'or');
            $documents->whereIn('id', $access_document, 'or');
        }
        // return $request->search;
        if (isset($request->search)) {  
            $documents = $documents->ofSearch($request->search);
            $old = array_merge($request->search, ['t' => $tab_active]);
        }

        $documents = $documents->orderBy('created_at', 'desc')->paginate(15);
        
        return view('documents.index')
            ->with(compact([
                'documents',
                'user',
                'title',
                'date_start',
                'date_end',
                'cabinets',
                'folders',
                'tab_active',
                'document_types',
                'old',
                'access_document'
                // 'unreadDocuments'
            ]));
    }

    public function getActiveTabToId($text){
        switch($text) {
            case 'inbox':
                return 1;
            case 'sent':
                return 2;
            default:
                return null;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $users = User::where('school_id', $user->school_id)
            ->where('id', '!=', $user->id)
            ->get();
        $cabinets = Cabinet::where('school_id', $user->school_id)->get();
        $statuses = DocumentStatus::all();
        return view('documents.create')
            ->with(compact([
                'cabinets',
                'user',
                'users',
            ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return old('folder_id');
        $validator = Validator::make($request->all(), [
            'send_to_cabinet_id' => 'required',
            'folder_id' => 'required',
            'type_id' => 'required',
            'cabinet_id' => 'required',
            'cabinet_id' => 'required',
            'code' => 'required',
            // 'receive_code' => 'required',
            'date' => 'required',
            'send_to_users' => 'required_if:submit_type,send',
            'comment' => 'required_if:submit_type,send',
            'reply_type_id' => 'required_if:submit_type,send',
            'approved_user_id' => 'required_if:reply_type_id,2',

            ],[
            'send_to_users.required_if' => "ข้อมูล ผู้รับ จำเป็นต้องกรอก หากต้องการส่งทันที",
            'comment.required_if' => "ข้อมูล ความคิดเห็น จำเป็นต้องกรอก หากต้องการส่งทันที",
            'reply_type_id.required_if' => "ข้อมูล ประเภทการตอบกลับ จำเป็นต้องกรอก หากต้องการส่งทันที",
            'approved_user_id.required_if' => "ข้อมูล ผู้อนุมัติเอกสาร จำเป็นต้องกรอก หากเอกสารเป็นประเภท แจ้งมาเพื่อทราบ และพิจารณา"
        ]);

        if($validator->fails()) {
                
            return redirect()
            ->route("document.create")
            ->withErrors($validator) 
            ->withInput(); 
        }

        $origin = $request->except(['_token', 'refers', 'approved_user_id', 'reply_type_id']);
        $user = auth()->user();
        $additions = [
            'user_id' => auth()->user()->id,
            'school_id' => auth()->user()->school_id,
        ];
        $documentModel = Document::create(
            array_merge($additions, $origin)
        );

        if( $request->submit_type == 'send' ) {
            $documentModel->update([
                'approved_user_id' => $request->approved_user_id,
                'reply_type_id' => $request->reply_type_id,
                'status' => 2,
            ]);
            $documentModel->accessibleUsers()->attach($user->id,[
                'document_user_status' => 2,
                'is_read' => 1
            ]);

            $documentModel->comments()->create([
                'author_id' => $user->id,
                'comment' => $request->comment 
            ]);
            foreach($request->send_to_users as $user_id) {
                $documentModel->accessibleUsers()->attach($user_id,[
                    'document_user_status' => 1
                ]);
            }
        }
        $documentModel->references()->sync($request->refers);

        if ( $request->file('files') ) {
            foreach($request->file('files') as $file){
                $date = date("Y_m_d");
                $documentModel->attachments()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $file->store("document/{$documentModel->id}")
                ]);
            }
        }

        if ( $request->attatch_file_id ) {
            $doc = OnlineDocument::where('id', $request->attatch_file_id)->first();
            
            $documentModel->attachments()->create([
                'name' => $doc->doc_title,
                'file_path' => 'online_document/'.$request->attatch_file_id.'.html'
            ]);
        }

        return redirect()
            ->route("document.index")
            ->withSuccess("ทำรายการสำเร็จ") ;
    }

    public function getReference(Request $request) {
        $status = 200;
        $user = auth()->user();
        $data['data'] = Document::where('school_id', $user->school_id)
            ->where("title", "like", "%{$request['query']}%")->take(5)->get();
        // return $request;
        return response()->json($data, $status) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::findOrFail($id);
        $user = auth()->user();
        $users_in_school = User::where('school_id', $user->school_id)->get();
        // $document->accessibleUsers()->attach($user->id, ['document_user_status' => 1]);
        $accessible = $user->accessibleDocuments->where('id', $document->id);
        $pivot = null; 
        if( $accessible->count() ) {
            $pivot = $accessible->first()->pivot ;
        } 
        // return $pivot ;
        if ( $document->school_id != $user->school_id) {
            abort(404);
        } else{
            return view('documents.show', compact([
                'document',
                'users_in_school',
                'pivot',
                // 'user'
            ]));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data = collect() ;
        $user = auth()->user();
        $document = Document::findOrFail($id);
        $cabinets = $user->cabinetPermissions;
        $users = User::where('school_id', $user->school_id)->get();

        return view('documents.edit', compact([
            'document',
            'users',
            'cabinets',
            'user'
            ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $documentModel = Document::findOrFail($id);

        switch ($request->action) {
            case 'update_status':
                return $this->updateStatus($documentModel, $request);
                break;
            default:
                return $this->updateAll($documentModel, $request);
                break;
        }
    }

    /**
     * update all data Dcoument
     * 
     * @param App\Models\Document $documentModel
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateAll(Document $model, Request $request) {
        if( isset($request->file_delete) ) {
            foreach( $request->file_delete as $file_id) {
                $model->attachments()->find($file_id)->delete();
            }
        }
        if ( $request->file('files') ) {
            foreach($request->file('files') as $file){
                $model->attachments()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $file->store("document/{$model->id}")
                ]);
            }
        }
        if ( $request->refers ) {
            $model->references()->sync($request->refers);
        }
        $model->update($request->except(['files', 'file_delete']));
        return redirect()->
            route('received', $model->id)
            ->withSuccess("ทำรายการสำเร็จ") ;
    }

    /**
     * update status
     * 
     * @param App\Models\Document $documentModel
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Document $model, Request $request) {
        $model->status = $request->status_value;
        $model->save();
        return redirect()
            ->route('document.index')
            ->withSuccess("ทำรายการสำเร็จ") ;
    }

    /**
     * 
     */
    public function send($id, Request $request) {

        // return $request->all();
        $documentModel = Document::findOrFail($id);
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
            // 'send_to_cabinet_id' => 'required',
            // 'folder_id' => 'required',
            // 'type_id' => 'required',
            // 'cabinet_id' => 'required',
            // 'cabinet_id' => 'required',
            // 'code' => 'required',
            // 'receive_code' => 'required',
            // 'date' => 'required',
            // 'receive_date' => 'required',
            'send_to_users' => 'required',
            'comment' => 'required',
            'reply_type_id' => 'required_if:submit_type,send',
            'approved_user_id' => 'required_if:reply_type_id,2',

            ],[
            'send_to_users.required' => "ข้อมูล ผู้รับ จำเป็นต้องกรอก",
            'comment.required' => "ข้อมูล ความคิดเห็น จำเป็นต้องกรอก",
            'reply_type_id.required_if' => "ข้อมูล ประเภทการตอบกลับ จำเป็นต้องกรอก",
            'approved_user_id.required_if' => "ข้อมูล ผู้อนุมัติเอกสาร จำเป็นต้องกรอก หากเอกสารเป็นประเภท แจ้งมาเพื่อทราบ และพิจารณา"
        ]);

        if($validator->fails()) {
            return redirect()
            ->route("document.edit", $documentModel->id)
            ->withErrors($validator) 
            ->withInput(); 
        }
        $documentModel->update([
            'approved_user_id' => $request->approved_user_id,
            'reply_type_id' => $request->reply_type_id,
            'status' => 2,
        ]);
        $documentModel->accessibleUsers()->attach($user->id,[
            'document_user_status' => 2,
            'is_read' => 1
        ]);

        $documentModel->comments()->create([
            'author_id' => $user->id,
            'comment' => $request->comment 
        ]);
        foreach($request->send_to_users as $user_id) {
            $documentModel->accessibleUsers()->attach($user_id,[
                'document_user_status' => 1
            ]);
        }

        return redirect()->route('document.index')
            ->withSuccess("ทำรายการสำเร็จ") ;
        
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Document::findOrFail($id)->delete();
        return redirect()
            ->route('document.index')
            ->withSuccess("ทำรายการสำเร็จ") ;
    }

    /**
     * 
     */
    public function assign(Document $document, Request $request) {
        $user = auth()->user();
        $document->accessibleDocuments()->sync($request->users);
        $info = array_merge( ["status"=>2], $request->except(["_token", "users"]));
        $document->update($info);
        return redirect()->back() 
            ->withSuccess("ทำรายการสำเร็จ") ;
        // return 
    }
    
    public function acknowledge(Document $document, Request $request) {
        $user = auth()->user();
        \DB::table('document_assignments')
            ->where("document_id", $document->id)
            ->where("user_id", $user->id)
            ->update(["status" => 2]);
        return redirect()->route('document.index') 
        ->withSuccess("ทำรายการสำเร็จ") ;

    }

    public function createPublishLink($id, Request $request) {
        $documentModel = Document::find($id);
        $documentModel->link()->create([
            'token' => md5(uniqid(rand(), true))
        ]);
        return redirect()->route('document.show', $id);
    }

    public function sendMail($id, Request $request) {
        $documentModel = Document::find($id);
        // return $request->all();
        $receivers = explode(" ", $request->emails);
        Mail::to( $receivers )
            ->send(new PublishDocument($documentModel));

        return redirect()->route('document.show', $id);

    }
}
