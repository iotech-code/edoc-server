<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\School;

use Validator;
use App\KeyValidator;



class SchoolController extends Controller
{
    public function index() {
        // return "school index";
        $schools = School::paginate(15);
        return view('back-office.school.index', compact([
            'schools'
        ]));
    }

    public function getUserID(Request $request) {
        $data = User::where("user_id", 'admin@'.$request->s)->get();
        return json_encode($data);
    }

    public function create() {
        return view('back-office.school.create');
    }

    public function store(Request $request) {
        // return $request->except(['_token']);
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:schools,code',
            'name' => 'required|unique:schools,name'
        ], [
            'code.required' => 'ข้อมูล รหัสโรงเรียน จำเป็นต้องกรอก',
            'code.unique' => 'ข้อมูล รหัสโรงเรียน ต้องไม่ซ้ำกันในระบบ',
            'name.required' => 'ข้อมูล ชื่อโรงเรียน จำเป็นต้องกรอก',
            'name.unique' => 'ข้อมูล ชื่อโรงเรียน ต้องไม่ซ้ำกันในระบบ'
        ]);

        $keyValidator = KeyValidator::checker($request->code, $request->key);

        if( !$keyValidator ) {
            // return "here";
            return redirect('back-office/school')
            ->withErrors([
                'invalide_key'=>'Key ของท่านไม่ถูกต้อง'
            ]) 
            ->withInput(); 
        }

        if($validator->fails()) {
            return redirect('back-office/school')
            ->withErrors($validator) 
            ->withInput(); 
        }

        $cabinets = [
            [
                'name' => "วิชาการ",
                "description" => ""
            ],
            [
                'name' => "ธุรการ",
                "description" => ""
            ],
            [
                'name' => "ปกครอง",
                "description" => ""
            ],
            [
                'name' => "การเงิน",
                "description" => ""
            ],
            
        ];
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
        $school->cabinets()->createMany(
            $cabinets
        );
        return redirect('/back-office/school')
            ->withSuccess("ทำรายการสำเร็จ");
    }
}
