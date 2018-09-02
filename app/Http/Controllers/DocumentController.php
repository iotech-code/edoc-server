<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Cabinet;

use Illuminate\Http\Request;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = Document::paginate(15);
        $title = $date_start = $date_end = "";
        $user = auth()->user();

        if (isset($request->search)) {
            // return $request->all();
            $documents = Document::where('school_id', auth()->user()->school_id)
                ->ofSearch($request->search)->paginate(15) ;
            $title = $request->search['title'];
            $date_start = $request->search['date_start'];
            $date_end = $request->search['date_end'];
        } 
        
        return view('documents.index')
            ->with(compact([
                'documents',
                'user',
                'title',
                'date_start',
                'date_end'
            ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabinets = Cabinet::where('school_id', auth()->user()->school_id)->get();
        return view('documents.create')
            ->with(compact([
                'cabinets'
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
        $origin = $request->except(['_token', 'refers']);
        $additions = [
            'user_id' => auth()->user()->id,
            'school_id' => auth()->user()->school_id,
        ];
        $documentModel = Document::create(
            array_merge($additions, $origin)
        );
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
        //
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
        return view('documents.edit')
            ->with(compact([
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
        $document->documentAssigns()->sync($request->users);
        $info = array_merge( ["status"=>2], $request->except(["_token", "users"]));
        $document->update($info);
        return redirect()->back() ;
        // return 
    }
}
