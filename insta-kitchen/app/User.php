<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     
     
      public function posts()
    {
        return $this->hasMany('App\Post');
    }
    
     public function notifications()
    {
        return $this->hasManyThrough('App\Notification', 'App\Post', 'user_id', 'post_id');
    }

     
     
    protected $fillable = [
        'name', 'email', 'password', 'country', 'city', 'phone_no', 'dob', 'address'  
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
