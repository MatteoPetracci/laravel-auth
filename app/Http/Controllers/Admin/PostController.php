<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class PostController extends Controller
{
    private $validation;
    public function __construct()
    {
        $this->validation = [
            'image'=>'required|string',
            'title'=>'required|string|max:255',
            'body'=>'required|string',
        ];
    } 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('ciao');
        // Salvo in una variabile tutti i post
        // $posts = Post::all();
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('store');
       $userId = Auth::user()->id;
       $idUser =  $userId;
       $request->validate($this->validation);
       $data = $request->all();
    
       $newpost = new Post;
       $newpost->fill($data);
       $newpost->user_id = $idUser;
       $newpost->slug = Str::slug($newpost->title, '/');
       $save = $newpost->save();
        if (!$save) {
            return redirect()->back();
        }
        // dd($user);
        // dd($idUser);
        return redirect()->route('admin.posts.show', $newpost->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // dd($slug);
        // Prendo il Post dove lo slug è uguale alla variabile $slug
        $post = Post::where('slug', $slug)->first();
        // dd($post);
        return view('admin.posts.show', compact('post'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('admin.posts.edit', compact('post'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (empty($post)) {
            abort('404');
        }
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
