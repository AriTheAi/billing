@extends('public/main')

@section('title')
View Post
@endsection

@section('content')
    <div class='panel panel-info'>
        <div class='panel-heading'>
            {{$post->title}}
        </div>
        <div class='panel-body'>
            {{$post->post}}
        </div>
        <div class='panel-footer'>
            Posted by {{ $post->author }} on {{ date('D M d, Y', $post->post_timestamp) }}
        </div>
    </div>
@endsection