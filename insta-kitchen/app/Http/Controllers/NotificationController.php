<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Http\Requests;
use App\Post;
use App\User;
use Session;
use Illuminate\Support\Facades\Auth;
use DB;

class NotificationController extends Controller
{
    
    public function __construct(){
         
        $this->middleware('auth');
    }
    public function index() {
    
        // update status .. 
        DB::table('notifications')
            ->where('user_to', Auth::user()->id)
            ->update(['is_read' => true]);
        
         // create variable and stor all posts from database
        $notifications  = Notification::where('status', 0)->orderBy('id', 'desc')->get();//->OrderBy('id', 'desc')->paginate(4);;
        $senders = User::all();
        $sents = Notification::with('user')->get();
        $process = Notification::where('status', 1)->orderBy('id', 'desc')->get();
        //$usernotification = $senders->notifications;
       //dd($user_notification);
        //
        //$user_notification = Notification::find('notifications')->where('post_id' , 'in', $notification->post()->first()->user_id);
       // $user_to = User::where('post_id', $notifications->post_id);
        //if (Auth::check()) {
        $user = User::find(Auth::user()->id);
       
        
        // return view and pass to the above variable 
        return view('notifications.index')->with('notifications', $notifications)->with('sents', $sents)->with('processes',  $process);
    }
    
    public static function getName ($id) {
        $name = \App\User::select('name')->where(['id' => $id])->get();
        
        return $name->name;
        
    }
    
     public function create()
    {
        $notifications = Notification::all();
        $posts = Post::all();
        $users = User::all();
        
        return view('notifications.create')->with('posts', $posts)->with('users', $users);
    }

 
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array('message' =>'required|max:300'));
        $post = Post::find($post_id);
        
        //dd( $request->rating );
        
        $notification = new Notification();
        $notification->message = $request->message;
        $notification->post()->associate($post);
        $notification->user_id = Auth::user()->id;
        $notification->user_to = $post->user_id;
        //$user_to = User::where('post_id', $post_id);
        //$notification->user_id = $user_to->user_id;
        
        
        
        $notification->save();
        
        Session::flash('success', 'Order successfully sent');
        
         return redirect()->back();
        
    }

}
