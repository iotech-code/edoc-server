<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
use App\Models\User;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class AuthController extends Controller
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

    public function postLogin(Request $request)
    {
        request()->validate([
            'user_id' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('user_id', 'password');
        $ds = $this->ldap_connect();
        $remember = $request->remember == 'on' ? 1:0;

        $authen = ldap_bind($ds, "cn=".$credentials['user_id'].",cn=user,ou=edocument,dc=mode-education,dc=com", $credentials['password']);
        
        if($authen) {
            $user = User::where('user_id', $credentials['user_id'])->first();
            Auth::login($user, $remember);
            return redirect()->intended('dashboard');
        } else {
            return Redirect::to("login")->withSuccess('Oppes! You have entered invalid credentials');
        }
        @ldap_close($ds);
    }
 
    public function postRegistration(Request $request)
    {  
        request()->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
        ]);
         
        $data = $request->all();
 
        $check = $this->create($data);
       
        return Redirect::to("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
     
    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
