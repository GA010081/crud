<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('created_at','desc')->paginate(6,['*'],'p');
        $comments=Comment::all();
        $data=[
        'comments'=>$comments,
        'posts'=>$posts,
        ];
        return view('posts.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->except('_token'));

        return redirect()->route('posts.show',$post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::find($id);
        if(is_null($posts))
        {
            return redirect()->route('posts.index')->with('message','你看不到我');
        }

        $data = compact('posts','comments');
        return view('posts.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $posts = Post::find($id);
        $data = compact('posts');

        return  view('posts.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $posts = Post::find($id);
        $posts->update($request->except('_token'));
        return redirect()->route('posts.show',$posts->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts=Post::destroy($id);

        $post=Post::all()->random();

        return redirect()->route('posts.show',$post->id);

    }
    public function hot()
    {
        $posts=Post::where('page_view','>',100)->orderBy('updated_at','desc')->get();

        $data=[

        'posts'=>$posts,

        ];
    return view('posts.index',$data);

    }
    public function random() {

    $posts=Post::all()->random();

    $data = compact('posts');
    
    return view('posts.show', $data);
    }
}
