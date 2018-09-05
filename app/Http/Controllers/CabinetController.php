<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cabinet;
use App\Models\User;

// use App\Http\Controllers\CabinetFolderTrait ;

class CabinetController extends Controller
{
    use CabinetFolderTrait ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabinets = Cabinet::paginate(8);

        return view("cabinets.index")
        ->with(compact([
            'cabinets'
        ]));;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $cabinets = Cabinet::paginate(15);
        return view("cabinets.create");

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request ;
        $user = auth()->user();
        $school_id =  $user->school_id;
        $create_cabinet_data = array_merge(
            $request->except(['_token', 'folder']),
            [
                "school_id" =>$school_id
            ]
        );
        // return [$request->folder, 'school_id' => $school_id];

        $cabinet = Cabinet::create($create_cabinet_data);
        $cabinet->permissions()->attach($user->id);
        $cabinet->folders()->create( array_merge($request->folder, ['school_id' => $school_id]));
        // return $cabinet->folders; 
        return redirect()->route("cabinet.index");
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
    public function edit(Cabinet $cabinet)
    {
        return view("cabinets.edit", compact([
            'cabinet'
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAjaxFolderByCabinetId($id) {
        $folders = Cabinet::find($id)->folders;
        return response()->json($folders);
    }

    public function permission(Cabinet $cabinet){
        $school_id = auth()->user()->school_id; 
        $users = User::where('school_id', $school_id)->get()->keyBy("id");
        // return $users;
        return view('cabinets.permission.index')
            ->with('users', $users)
            ->with('cabinet', $cabinet);
    }


    public function updatePermission(Cabinet $cabinet, Request $request){
        // return $request->all();
        $cabinet->permissions()->sync($request->users);
        return redirect()->back();
    }

    // public function getAjax


}
