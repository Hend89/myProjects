<?php 
 namespace App;
 
 use Illuminate\Database\Eloquent\Model;
 
 class Category extends Model
 {
    protected $table = 'categories';
    
    public function scopeSearch ($query, $s) {
        return $query->where('name', 'like', '%' .$s.'%');
    }


     public function posts()
    {
        return $this->hasMany('App\Post');
    }
 }