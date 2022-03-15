<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Hash ;

class UserController extends Controller
{
    private $ldap_server;
    private $ldap_port;
    private $base_dn;

    public function __construct()
    {
        $this->ldap_server = env("LDAP_HOSTS");
        $this->ldap_port = env("LDAP_PORT");
        $this->base_dn = env("LDAP_BASE_DN");
    }
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

    private function ldap_connect() {
        $ds = ldap_connect($this->ldap_server, $this->ldap_port); //always connect securely via LDAPS when possible
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        return $ds;
    }

    public function migrate() {
        $users = User::where('role_id', '=', 1)->limit(200)->get();
        $ds = $this->ldap_connect();
        if ($ds) {
            $r = ldap_bind($ds, env('LDAP_ADMIN_USER'), env('LDAP_ADMIN_PASSWORD'));
            foreach($users as $user) {
                $info["cn"]=$user->fullname;
                $info["displayName"]=$user->fullname;
                $info["givenName"]=$user->first_name;
                $info["sn"]=$user->last_name;
                $info["uid"]=$user->user_id;
                $info["userPassword"]=$user->user_id;
                $info["mail"]=$user->email;
                $info["o"]=$user->school_id;
                $info["ou"]=$user->role_id;
                $info["objectclass"]="inetOrgPerson";

                $dn = "cn=".$user->user_id.",cn=user,ou=edocument,dc=mode-education,dc=com";
                echo $user->id."=".$dn."<br>";

                $r = ldap_add($ds, $dn, $info);
            }
        }

  
        // return response()->json($users);
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
