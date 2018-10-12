<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\School;

use Validator;

class SchoolController extends Controller
{
    public function index() {
        // return "school index";
        $schools = School::paginate(15);
        return view('back-office.school.index', compact([
            'schools'
        ]));
    }

    public function create() {
        return view('back-office.school.create');
    }

    public function store(Request $request) {
        // return $request->except(['_token']);
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:schools,code'
        ]);

        if($validator->fails()) {
                
            return redirect('back-office')
            ->withErrors($validator) 
            ->withInput(); 
        }

        $school = School::create(
            $request->except(['_token'])
        );
        $school->users()->create([
            'user_id' => "admin@{$request->code}",
            'password' => bcrypt("password"),
            'first_name' => "Admin",
            'last_name' => "Admin",
            'role_id' => 1,

        ]);
        return redirect('/back-office');
    }
}
