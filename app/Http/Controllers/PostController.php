<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
class PostController extends Controller
{
    public function index() 
    {
        // Salvo in una variabile tutti i post
        $posts = Post::all();
        return view('guest.posts.index', compact('posts'));
    }
    public function show($slug) 
    {
        $onePost = Post::where('slug', $slug)->first();
        if(!empty($onePost)) {
            return view('guest.posts.show', compact('onePost'));
        } else {
            abort('404');
        }
    }
}
