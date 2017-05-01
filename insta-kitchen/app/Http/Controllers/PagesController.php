<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use DB;
use App\Tag;
use Session;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Notification;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller {
    
     public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
    
    public function index(Request $request)
    {
        $s = $request->input('s');
       // $user_city = User::find(Auth::user()->id);
        // create variable and stor all posts from database
        $posts  = Post::with('user')
        ->where('quantity', '>', 0)
        ->orderBy('posts.created_at', 'desc')
        ->search($s)
        ->paginate(4);
        
        // return view and pass to the above variable 
        return view('pages.welcome', compact('posts', 's'))->with('posts', $posts);
       
    }
    

    
    public static function getRating($id) {
    
    $total_raters = DB::table('comments')->where('post_id', $id)->where('rating', '<>', 'null')->count();
    
    return $total_raters;
    }
    
    public static function getUsername($id) {
    
    $users = User::where('id', '=', $id);
    $username = $users->name;
    return $username;
    }
    
       public static function getNotifications() {
           if (Auth::check()) {
            $total_notifications = DB::table('notifications')->where('user_to', Auth::user()->id)->where('is_read', '=', false)->count();
            
            return $total_notifications;
           } else {
               return null;
           }
       }
 
    
    
    
    public function getAbout() {
        $name = 'Hend';
        $year = 2017;
        
        $all = $name . " " . $year;
        
        return view('pages.about')->withCopyright($all)->withYear($year);
    }
    
    public function getContact() {
        return view('pages.contact');
    }
    
   public function getIndex() {
        # process variables or params
        //talk to the model
        // recieve from the model
        // compile or process data
        // return to the correct view 
        
        if (Auth::check()) {
        $user_city = User::find(Auth::user()->id);
       
           $contents = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'users.name as username', 'categories.name as catname')
            ->where('users.city', '=', $user_city->city)
            ->OrderBy('id', 'desc')
            ->paginate(5);
        } else {
             $contents = DB::table('posts')
            ->join('users', 'users.id', '=', 'posts.user_id')
            ->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'users.name as username', 'categories.name as catname')
            ->OrderBy('id', 'desc')
            ->paginate(5);
        }
            $tags = DB::table('tags')
            ->join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
            ->join('posts', 'posts.id', '=', 'post_tag.post_id')
            ->where('post_tag.post_id', '=', '$contents->id')
            ->select('tags.*')
            ->get();
            
            $search = Tag::all();
            
            $total_raters = DB::table('comments')->where('rating', '<>', 'null')->count();
       
    
            
           
        return view('pages.welcome')->withContents($contents)->withTags($tags);
    }
    
 
     
    
}