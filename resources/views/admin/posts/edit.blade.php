@extends('layouts.app')
@section('content')
    <form action="{{route('admin.posts.update', $post)}}" method="POST">

        @csrf
        <div style="margin-left:50px">
            <label for="image">Image</label> 
            <input type="text" name="image" id="image" value="{{$post->image}}" > <br>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{$post->title}}"> <br>
            <label for="body">Body</label> <br>
            <textarea  name="body" id="body" cols="25" rows="15">{{$post->body}}</textarea><br>
            <button class='btn btn-primary' type="submit">Save</button>
        </div>
        
        <input type="hidden" name="user_id" value='{{Auth::id()}}'>
        
        
        @method('PATCH')

    </form>
@endsection