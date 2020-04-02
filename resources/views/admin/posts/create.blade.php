@extends('layouts.app')
@section('content')
    <form action="{{route('admin.posts.store')}}" method="POST" enctype="multipart/form-data">

        @csrf
        <div style="margin-left:50px">
            <label for="image">Image</label> 
            <input type="text" name="image" id="image"> <br>
            <label for="title">Title</label>
            <input type="text" name="title" id="title"> <br>
            <label for="body">Body</label> <br>
            <textarea  name="body" id="body" cols="25" rows="15"></textarea><br>
        </div>
        
        <input type="hidden" name="user_id" value='{{Auth::id()}}'>
        <label for="tags">All Tags</label>
        @foreach ($tags as $tag)
            <h4 style="display:inline-block">{{$tag->name}}</h4>
            <input type="checkbox" name="tag[]" value="{{$tag->id}}" id="">
        @endforeach

        <input type="file" name="path_img" accept="image/" id="">

        <button class='btn btn-primary' type="submit">Save</button>
        
        @method('POST')

    </form>
@endsection