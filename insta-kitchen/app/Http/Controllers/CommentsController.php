<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Post;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
         
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $this->validate($request, array(
            'comment' =>'required|max:300',
            'rating' => 'integer'));
        $post = Post::find($post_id);
        
        //dd( $request->rating );
        
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($post);
        $comment->user_id = Auth::user()->id;
        
        if ($request->rating <> 0) {
            $comment->rating = $request->rating;
        }
        
        $comment->save();
        
        Session::flash('success', 'Comment successfully added');
        
        return redirect()->route('posts.show', $post->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $comment = Comment::find($id);
       return view('modal.edit_comment')->withComment($comment);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        
        $this->validate($request, array('comment' =>'required'));
        
        $comment->comment = $request->comment;
        $comment->save();
        
        Session::flash('success', 'Comment successfully updated');
        
        return redirect()->route('posts.show', $comment->post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
       
       
       $comment->delete();
       
       Session::flash('success', 'Your comment successfuly deleted!');
       return redirect()->route('posts.show', $comment->post->id);
    }
}
