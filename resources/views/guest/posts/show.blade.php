{{-- @dd($onePost) --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                    <h3>{{$onePost->title}}</h3>
                    <p>{{$onePost->user->name}}</p>
                    <p>{{$onePost->body}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @foreach ($onePost->comments as $comment)
                    <p>{{$comment->name}}</p>
                    <p style="border:2px solid black">{{$comment->body}}</p>
                    <p>{{$comment->email}}</p>

                @endforeach
            </div>
        </div>
        <div class="row" style="margin-top:30px">
            <div class="col-12">
                <h4>Insert a comment</h4>
                <form action="" method="post">
                    @csrf
                    <label for="name">Name User</label>
                    <input type="text" name="name" id=""> <br>
                    <label for="body">Comment</label><br>
                    <textarea name="body" id="" cols="30" rows="10"></textarea><br>
                    <label for="email">Email User</label>
                    <input type="text" name="email" id=""><br>
                    <button class="btn btn-primary" type="submit">Send</button>
                    @method('POST')
                </form>
                
            </div>
        </div>
    </div>
@endsection