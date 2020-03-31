{{-- @dd($posts) --}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @foreach ($posts as $post)
                    <h3>{{$post->title}}</h3>
                    <p>{{$post->user->name}}</p>
                    <p>{{$post->body}}</p>
                <a class="btn btn-success" href="{{route('posts.show', $post->slug)}}">Clicca qui</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection