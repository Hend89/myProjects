<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function scopeSearch ($query, $s) {
        return $query->where('title', 'like', '%' .$s.'%')
        ->orWhere('description', 'like', '%' .$s.'%');
    }
    //protected $table = 'content';
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    
     public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
      public function notifications() {
        return $this->hasMany('App\Notification');
    }
    
}

