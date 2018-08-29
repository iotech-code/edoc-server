<?php

namespace App\Http\Controllers;

use App\Models\Document;

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

        if (isset($request->search)) {
            // return $request->all();
            $documents = Document::ofSearch($request->search)->paginate(15) ;
            $title = $request->search['title'];
            $date_start = $request->search['date_start'];
            $date_end = $request->search['date_end'];
        } 
        
        return view('documents.index')
            ->with(compact([
                'documents',
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
        return view('documents.create');
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

        $documentModel = Document::create(
            $request->except(['_token'])
        );

        foreach($request->file('files') as $file){
            $documentModel->attachments()->create([
                'name' => $file->getClientOriginalName(),
                'file_path' => $file->store("document/{$documentModel->id}")
            ]);
        }

        return redirect()
            ->route("document.index")
            ->with(['status'=>'success']) ;
        // return $request->all();
    }

    public function getReference(Request $request) {
        $status = 200;
        $data['data'] = [];
        return resonse()->json($data, $status) ;
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
        $this->data->document = Document::findOrFail($id);
        $data = $this->data ;
        return view('documents.edit')
            ->with(compact('data'));
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
        $model->update($request->except(['files']));
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
}
