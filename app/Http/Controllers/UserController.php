<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Hash ;

class UserController extends Controller
{

    /**
     * 
     */
    public function edit() {
        $user = \Auth::user() ;
        return view("users.profile")
            ->with(compact([
                'user'
            ]));
    }

    public function update(Request $request) {
        $update_data = $request->only(['first_name', 'last_name']);
        $validatedData = \Validator::make($request->all(), [
            'new_password' => 'confirmed|min:6',
            'old_password' => [
                'required_with:new_password',
                function($attribute, $value, $fail) {
                    if(!Hash::check($value, auth()->user()->password)){
                        return $fail('รหัสผ่านปัจจุบันไม่ถูกต้อง');
                    }
                },
            ]
        ]);
        if( $validatedData->fails() ) {
            return redirect()->route("user.profile")
                ->withErrors($validatedData->errors());
        } else {
            if (isset($request->new_password)) {
                $update_data['password'] = bcrypt($request->new_password);
            }
            auth()->user()->update($update_data);

            return redirect()->route("user.profile")
            ->withSuccess("ทำรายการสำเร็จ");
            
        }
    }


    public function getAjaxUserByName(Request $request) {
        $user = auth()->user() ;
        return User::where('school_id', $user->school_id)
            ->ofSearchByName($request->search)
            ->paginate(5);
    }
}
