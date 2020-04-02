<?php

namespace App\Http\Controllers\Admin;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


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
        // Prendo tutti i tag
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //    dd($request->all());
       $userId = Auth::user()->id;
       $idUser =  $userId;
       $request->validate($this->validation);
       $data = $request->all();
       $pathImg = Storage::disk('public')->put('images', $data['path_img']);
       $newpost = new Post;
       $newpost->fill($data);
       $newpost->user_id = $idUser;
       $newpost->slug = Str::slug($newpost->title, '/');
       $newpost->path_img = $pathImg;
       $save = $newpost->save();

        if (!$save) {
            return redirect()->back();
        }
        $newtags = $data['tag'];
        $newpost->tags()->attach($newtags);
        // dd($newpost);
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
        $tags = Tag::all();
        $data = [
            'tags' => $tags,
            'post' => $post
        ];
        // return view('admin.posts.edit', compact('post'));
         return view('admin.posts.edit', $data);


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
        
        // dd($request->all());
        $userId = Auth::user()->id;
        $idUser =  $userId;
        $request->validate($this->validation);
        $data = $request->all();
        
        $post->fill($data);
        $post->user_id = $idUser;
        $post->slug = Str::slug($post->title, '/');
        $post->updated_at = Carbon::now();
        $save = $post->update();
        if (!$save) {
            return redirect()->back();
        }
        $newtags = $data['tag'];
        $post->tags()->sync($newtags);
        // dd($user);
        // dd($idUser);
        return redirect()->route('admin.posts.show', $post->slug);
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
        $post->comments()->delete();
        $post->tags()->detach();
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
