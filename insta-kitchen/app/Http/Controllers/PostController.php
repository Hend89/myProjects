<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Image;
use Illuminate\Support\Facades\Input;
use Session;
use File;
use DB;
use App\Category;
use App\Tag;
use App\User;


use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function __construct(){
         
        $this->middleware('auth');
        //$this->middleware('auth', ['except' => '']);
    }
       
    public function index($id)
    {
        // create variable and stor all posts from database
        $posts  = Post::with('user')
        ->where('user_id', $id)
        ->orderBy('id', 'desc')
        ->paginate(10);
        //dd($id);
       if(!empty($posts)) {
        // return view and pass to the above variable 
        return view('posts.index')->with('posts', $posts);
       } else {
          
           view('posts.index')->with('posts', null);
       }
    }
    
    
   
    
    public static function getUserName($id) {
        $user = User::find($id);
        $name = $user->name;
        return $name;
    }
    
    public static function getUserImage($id) {
        $user = User::find($id);
        $image = $user->image;
        return $image;
    }
 
    public function scopeSearch ($query, $s) {
        return $query->where('title', 'like', '%' .$s.'%');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.create')->with('categories', $categories)->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        // validate data
        $this->validate($request, array(
            'title' => 'required|max:120',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png'));
            
        //save to database
        $post = new Post;
        
        $post->title = $request->title;
        $post->description = $request->description;
        $post->price = $request->price;
        $post->quantity = $request->quantity;
        $post->user_id = Auth::user()->id;
        $post->category_id = $request->category_id;
        
        // name image if file uploaded 
        
        if ($request->file('image')) {
            $imageName = time() . '-' . rand(1111,9999) . '.' . $request->file('image')->getClientOriginalExtension();
            $post->image = $imageName;
            $imgPath = public_path(). '/images/posts/';
            
            //$image = Input::file('image');
            //Image::make($image->getRealPath())->resize(260, 260)->save($imgPath);
            $request->file('image')->move($imgPath, $imageName);
            }
        
    // save product 
        $post->save();
        
    // save tags
    if(!empty($request->tags)){
        $post->tags()->sync($request->tags, false);
    }  

    
    
    Session::flash('success', 'A new post sucssfully sumbitted!');
          
            
    // redirect
    return redirect()->route('posts.show', $post->id);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        // get the rating
        $rating = DB::table('comments')
                ->where('post_id', $id)
                ->avg('rating');
        $total_raters = DB::table('comments')->where('post_id', $id)->where('rating', '<>', 'null')->count();
        
        
        $post = Post::find($id);
        
        return view('posts.show')->with('post' , $post)->with('rating', $rating)->with('total_raters', $total_raters);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post and save it as var
        $post = Post::find($id);
        // get categories
        $categories = Category::all();
       
     
        $posttags =  Tag::join('post_tag', 'tags.id', '=', 'post_tag.tag_id')
      ->where('post_tag.post_id',$id)->get();
      
       
    
        $tags = Tag::all();
        
        
        // check if user allowed to edit
        if (Auth::user()->id == $post->user_id ) {
             // return and pass the var previously created 
            return view('posts.edit')->withPost($post)->withCategories($categories)->withTags($posttags)->withAlltags($tags);
        }
        
        return redirect()->back();
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
        // validate data
        $this->validate($request, array(
            'title' => 'required|max:120',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png'));
            
        //save to database
        
        $post = Post::find($id);
        
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->price = $request->input('price');
        $post->quantity = $request->input('quantity');
       
        $post->category_id = $request->input('category_id');
        
        // name image if file uploaded 
        
        if (Input::file('image')) {
            // check if image is not default 
            if ($post->image != 'default_food.jpg') {
            // delete old image 
            File::delete( public_path(). '/images/posts/'. $post->image );
            }
            // save new one
            $destinationPath = public_path(). '/images/posts/';
            $extension = Input::file('image')->getClientOriginalExtension();
            var_dump($extension);
            $imageName = time() . '-' . rand(1111,9999) . '.' . $extension;
            Input::file('image')->move($destinationPath, $imageName);
                    
            
            $post->image = $imageName;
        }
        
     // save post 
        $post->save();
        
     // save tags
     if (isset($request->tags)) {
         $post->tags()->sync($request->tags);
         } else {
             $post->tags()->sync(array());
         }
        

    
    
    Session::flash('success', 'Your Post successfuly updated!');
          
            
    // redirect
    return redirect()->route('posts.show', $post->id);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
       $post = Post::find($id);
       
        // delete old image 
        if ($post->image != 'default_food.jpg') {
            File::delete( public_path(). '/images/posts/'. $post->image );
        }
        
        // delete tags posts relationship
        $post->tags()->sync(array());
       
       $post->delete();
       
       Session::flash('success', 'Your Post successfuly deleted!');
       return redirect()->route('posts.index');
    }

    
}
