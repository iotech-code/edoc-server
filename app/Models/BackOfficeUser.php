<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BackOfficeUser extends Authenticatable
{
    protected $table = 'back_office_users';
    

    /**
     * combine firstname and last name
     * 
     * @return string $fullname
     */
    public function getFullNameAttribute() {
        return $this->attributes['first_name']." ".$this->attributes['last_name']; 
    }
}
