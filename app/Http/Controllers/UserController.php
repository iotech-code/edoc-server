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
        // return dd(auth()->user()->first_name);
        auth()->user()->update($request->only(['first_name', 'last_name']));
        if( !is_null($request->new_password) ) {
            return $this->updatePassword($request);
        }
        return redirect()->route("user.profile");
    }

    public function updatePassword(Request $request) {
        $validatedData = \Validator::make($request->all(), [
            'new_password' => 'confirmed',
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
                ->withErrors($validatedData);
        } else {
            return redirect()->route("user.profile");
            
        }
    }

    public function getAjaxUserByName(Request $request) {
        // return auth()->user();
        $user = auth()->user() ;
        return User::where('school_id', $user->school_id)
            ->ofSearchByName($request->search)
            // ->appends(['full_name'])
            ->paginate(5);
    }
}
