@extends('layouts.app')
@section('content')
<a class="btn btn-success" href="{{route('admin.posts.create')}}">CREATE NEW POST</a>
<table class="table">
    <thead>
        <th>ID</th>
        <th>USER ID</th>
        <th>IMAGE</th>
        <th>TITLE</th>
        <th>CREATED AT</th>
        <th>UPDATED AT</th>
        <th colspan="3"></th>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->user_id}}</td>
            <td>{{$post->image}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->created_at}}</td>
            <td>{{$post->updated_at}}</td>
            <td><a href="{{route('admin.posts.show', $post->slug)}}">SHOW</a></td>
            <td><a href="{{route('admin.posts.edit', $post->slug)}}">EDIT</a></td>
            <td>
               <form action="{{route('admin.posts.destroy', $post->id)}}" method="POST">
                   @csrf
                   @method('DELETE')
                    <button type="submit">DELETE</button>
                </form> 
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection