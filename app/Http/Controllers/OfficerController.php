<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Auth;
use FastExcel;
use Storage ;

class OfficerController extends Controller
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

    public function index(){
        $user = Auth::user() ;
        $officers = User::where("school_id", $user->school_id)->get();
        return view('officers.index', compact([
            'officers'
        ]));
    }

    public function edit($id) {
        $officer = User::findOrFail($id);
        return view('officers.index', compact(
            'officer'
        ));
    }

    /**
     * Import User In school by use CSV file
     */
    public function import(Request $request) {
        $school_id = Auth::user()->school_id;
        $store_path = $request->file('import_file')->storeAs("tmp", $request->file('import_file')->getClientOriginalName());
        $duplicate = [];
        $col = (new FastExcel)->import(storage_path("app/$store_path"), function($line) use($school_id, &$duplicate){
            if (User::where('user_id', $line['id'])->count() ==0 ) {
                $ds = $this->ldap_connect();
                if ($ds) {
                    $r = ldap_bind($ds, env('LDAP_ADMIN_USER'), env('LDAP_ADMIN_PASSWORD'));

                    $info["cn"]=$line['first_name']." ".$line['last_name'];
                    $info["displayName"]=$line['first_name']." ".$line['last_name'];
                    $info["givenName"]=$line['first_name'];
                    $info["sn"]=$line['last_name'];
                    $info["uid"]=$line['id'];
                    $info["userPassword"]=$line['id'];
                    $info["mail"]=$line['email'];
                    $info["o"]=$school_id;
                    $info["ou"]=2;
                    $info["objectclass"]="inetOrgPerson";
    
                    $dn = "cn=".$line['id'].",cn=user,ou=edocument,dc=mode-education,dc=com";
                    $r = ldap_add($ds, $dn, $info);
                    @ldap_close($ds);
                }
                return User::create([
                    'user_id' => $line['id'],
                    'password' => bcrypt($line['id']),
                    'role_id' => 2,
                    'school_id' => $school_id,
                    'first_name' => $line['first_name'],
                    'last_name' => $line['last_name'],
                    'email' => $line['email'],
                ]);
            } else {
                $line['user_id'] = $line['id'];
                unset($line['id']);
                return User::where('user_id', $line['user_id'])->update(
                    $line
                );
            }

        });
        return redirect()->back();
    }

    public function store(Request $request) {
        $addition = [
            'password' => bcrypt($request->user_id),
            'role_id' => 2
        ];
        $ds = $this->ldap_connect();
        if ($ds) {
            $r = ldap_bind($ds, env('LDAP_ADMIN_USER'), env('LDAP_ADMIN_PASSWORD'));

            $info["cn"]=$request->first_name." ".$request->last_name;
            $info["displayName"]=$request->first_name." ".$request->last_name;
            $info["givenName"]=$request->first_name;
            $info["sn"]=$request->last_name;
            $info["uid"]=$request->user_id;
            $info["userPassword"]=$request->user_id;
            $info["mail"]=$request->email;
            $info["o"]=$request->school_id;
            $info["ou"]=2;
            $info["objectclass"]="inetOrgPerson";

            $dn = "cn=".$request->user_id.",cn=user,ou=edocument,dc=mode-education,dc=com";
            $r = ldap_add($ds, $dn, $info);
            @ldap_close($ds);
        }
        User::create( array_merge($request->all(), $addition));
        return redirect()->back();
    }

    public function password_reset(Request $request) {
        $new_password = [
            'password' => bcrypt($request->user_id)
        ];
        $user = User::where('user_id', $request->user_id)->update($new_password);

        return redirect()->back()->withSuccess('ทำรายการสำเร็จ');
    }

    public function destroy($id){
        User::findOrFail($id)->delete();
        return redirect()->back();
    }
}
