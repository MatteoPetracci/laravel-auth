<?php


namespace App\Http\Controllers;
use App\Post;
use App\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $validation;
    public function __construct()
    {
        $this->validation = [
            'name'=>'required|string',
            'email'=>'required|email',
            'body'=>'required|string',
            'post_id'=>'required|numeric',
        ];
    } 

    public function store(Request $request) 
    {
       $request->validate($this->validation);
       $data = $request->all();
       $newComment = new Comment;
       $newComment->fill($data);
       $save = $newComment->save();
       if (!$save) {
        return redirect()->back();
      }

      return redirect()->route('posts.show', $newComment->post->slug);
        
    }
}
