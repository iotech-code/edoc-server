<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return App\Models\Role
     */
    public function role() {
        return $this->belongsTo(Role::class);
    }

     /**
     * @return App\Models\School
     */
    public function school() {
        return $this->belongsTo(School::class);
    }


    /**
     * combine firstname and last name
     * 
     * @return string $fullname
     */
    public function getFullNameAttribute() {
        return $this->attributes['first_name']." ".$this->attributes['last_name']; 
    }
    
}
