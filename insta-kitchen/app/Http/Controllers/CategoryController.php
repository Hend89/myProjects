<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Post;


class CategoryController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //search
        
        $s = $request->input('s');
        //display and create function
        if(Auth::user()->status == 0) {
        $categories = Category::latest()
        ->where('id', '<>', 13)
        ->search($s)
        ->paginate(20);
        return view('categories.index', compact('categories', 's'))->with('categories', $categories);
        } else {
            return null;
        }
        
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate and save
        $this->validate($request, array(
            'name' => 'required|max:50'));
            
        $category = new Category;
        
        $category->name = $request->name;
        
        $category->save();
        
        Session::flash('success', 'Category successfuly added.');
        
        return redirect()->route('categories.index');
        
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $posts = Post::where('category_id', $id);
        
        Post::where('category_id', $id)
          ->update(['category_id' => 13]);
        
        $category->delete();
        
        Session::flash('success', 'Category deleted successfuly');
        
        return redirect()->route('categories.index');
    }
}
