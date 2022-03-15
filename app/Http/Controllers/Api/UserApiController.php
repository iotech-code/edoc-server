<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth ;
use App\Models\User;
class UserApiController extends Controller
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

    private function ldap_connect() {
        $ds = ldap_connect($this->ldap_server, $this->ldap_port); //always connect securely via LDAPS when possible
        ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
        ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
        return $ds;
    }

    // public function login(Request $request) {
    //     $ds = $this->ldap_connect();
  
    //     if ($ds) {
    //         $authen = ldap_bind($ds, "cn=".request('user_id').",cn=user,ou=edocument,dc=mode-education,dc=com", request('password'));
    //         if($authen) {
    //             echo "login successfully";
    //         } else {
    //             echo "login fail!";
    //         }
    //     }
    // }
 
    public function login(){
        if(Auth::attempt(['user_id' => request('user_id'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success = $user;
            $success['token'] =  $user->createToken('edoc')->accessToken; 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }
}
