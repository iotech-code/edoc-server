<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * 
     */
    public function profile() {
        $user = \Auth::user() ;
        return view("users.profile");
    }
}
