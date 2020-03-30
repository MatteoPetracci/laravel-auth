@extends('layouts.app')
@section('content')

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
            <td>VIEW</td>
            <td>EDIT</td>
            <td>DELETE</td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection