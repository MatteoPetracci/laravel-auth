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
                @endforeach
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-12">
                <form action="" method="post">
                    @csrf





                    @method('POST')
                </form>
                
            </div>
        </div> --}}
    </div>
@endsection