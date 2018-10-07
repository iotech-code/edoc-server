<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\DocumentStatus;
use App\Models\Folder;
use App\Models\Cabinet;
use App\Models\User;
use App\Models\DocumentType;

use App\Http\Controllers\Traits\DocumentReply ;
use App\Http\Controllers\Traits\DocumentCommentTrait ;
use App\Http\Controllers\Traits\DocumentRespondTrait ;

use Illuminate\Http\Request;

class DocumentController extends Controller
{

    use DocumentReply,
        DocumentRespondTrait,
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
            // return $current_active_tab;
            $documents->whereIn('id', $access_document);
        } else {
            $access_cabinet_list = $user->cabinetPermissions()->get()->pluck(['id']);
            $access_document = $user->accessibleDocuments()->get()->pluck(['id']);
            $documents->whereIn('cabinet_id', $access_cabinet_list);
            $documents->whereIn('send_to_cabinet_id', $access_cabinet_list, 'or');
            $documents->whereIn('id', $access_document, 'or');

        }

        
        // return $current_active_tab;
        if (isset($request->search)) {  
            $documents = $documents->ofSearch($request->search) ;
            // $old['title'] = $request->search['title'];
            // $old['date_start'] = $request->search['date_start'];
            // $old['date_end'] = $request->search['date_end'];
            $old=$request->search;
        } else {

        }

        // return $old;


        
        $documents = $documents->orderBy('created_at')->paginate(15);
        
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
                'old'
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
        $users = User::where('school_id', $user->school_id)->get();
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
        // return dd($request->files) ;

        $origin = $request->except(['_token', 'refers', 'approved_user_id', 'reply_type']);
        $user = auth()->user();
        $additions = [
            'user_id' => auth()->user()->id,
            'school_id' => auth()->user()->school_id,
        ];
        $documentModel = Document::create(
            array_merge($additions, $origin)
        );

        if( $request->submit_type == 'send' ) {
            // return "test";
            // $document->update($request)
            $documentModel->update([
                'approved_user_id' => $request->approved_user_id,
                'reply_type' => $request->reply_type,
                'status' => 2,
            ]);
            $documentModel->accessibleUsers()->attach($user->id,[
                'document_user_status' => 2
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
                $documentModel->attachments()->create([
                    'name' => $file->getClientOriginalName(),
                    'file_path' => $file->store("document/{$documentModel->id}")
                ]);
            }
        }

        return redirect()
            ->route("document.index")
            ->with(['status'=>'success']) ;
        // return $request->all();
    }

    public function getReference(Request $request) {
        $status = 200;
        $data['data'] = Document::where("title", "like", "%{$request['query']}%")->take(5)->get();
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
        $document = Document::findOrFail($id);
        $cabinets = Cabinet::where('school_id', auth()->user()->school_id)->get();
        return view('documents.edit', compact([
            'document',
            'cabinets'
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
        // return $request->all() ;
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
            route('document.edit', $model->id);
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
        // return $model;
        // return $request->status_value;
        return redirect()
            ->route('document.index')
            ->with(['status'=>'success']) ;
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
            ->with(['status'=>'success']) ;
    }

    /**
     * 
     */
    public function assign(Document $document, Request $request) {
        $user = auth()->user();
        $document->accessibleDocuments()->sync($request->users);
        $info = array_merge( ["status"=>2], $request->except(["_token", "users"]));
        $document->update($info);
        return redirect()->back() ;
        // return 
    }
    
    public function acknowledge(Document $document, Request $request) {
        $user = auth()->user();
        \DB::table('document_assignments')
            ->where("document_id", $document->id)
            ->where("user_id", $user->id)
            ->update(["status" => 2]);
        return redirect()->route('document.index') ;

    }
}
