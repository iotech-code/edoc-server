<?php

namespace App\Http\Controllers\BackOffice;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\BackOfficeUser ;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    public function showLoginForm(){
        if (Auth::guard('seller')->check()) {
            return redirect()->route('back-office.school.index');
        } else{
            return view('back-office.login');

        }
    }

    public function credentials(Request $request) {

        return $request->only(['user_id', 'password']);
    }

    public function login(Request $request) {
        if (Auth::guard('seller')->check()) {
            return redirect()->route('back-office.school.index');
        }
        elseif ( $this->attempt($request) ){
            $officer = BackOfficeUser::where('user_id', $request->user_id)->first();
            Auth::guard('seller')->login($officer);
            // return $request->all();
            return redirect()->route('back-office.school.index');
        } else {
            return redirect()->back()->withErrors([
                'user' => 'เข้าสู่ระบบไม่สำเร็จ โปรดตรวจสอบข้อมูลของท่าน'
            ]);
        }
        
    }

    public function logout(){
        if (Auth::guard('seller')->check() ){
            Auth::guard('seller')->logout(); 
            return redirect()->route('back-office.school.index');
        } else {
            return redirect()->route('back-office.loginForm');
        }
    }

    public function attempt(Request  $request){

        return Auth::guard('seller')
            ->attempt(
                [
                    'user_id' => $request->user_id, 
                    'password' => $request->password,
                ]
                // true
            );
    }

}
