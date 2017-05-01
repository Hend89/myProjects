<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use Session;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    public function index() {
        if(Auth::user()->status == 0) {
        $tags = Tag::all();
        return view('tags.index')->withTags($tags);
        }
        else {
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
        $this->validate($request, array('name' => 'required|max:50'));
        $tag = new Tag;
        $tag->name = $request->name;
        
        $tag->save();
        
        Session::flash('success', 'Tag successfully added');
   
    return redirect()->route('tags.index');
    
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->status == 0) {
        $tag = Tag::find($id);
        return view('tags.show')->withTag($tag);
        } else {
            return null;
        }
    }

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
        $tag = Tag::find($id);
        $tag->posts()->detach();
        
        $tag->delete();
        
        Session::flash('success', 'Tag deleted successfuly');
        
        return redirect()->route('tags.index');
    }
}
