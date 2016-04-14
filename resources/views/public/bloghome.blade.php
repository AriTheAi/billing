@extends('public/main')

@section('title')
Blog
@endsection

@section('content')
    @foreach($posts as $post)
        @if($post->visible == 1)
        <div class='panel panel-info'>
            <div class='panel-heading'>
                {{ $post->title }}
            </div>
            <div class='panel-body'>
                {{ substr($post->post, 0, 250) }}...<br>
                <a href="/blog/{{$post->id}}" class="btn btn-primary">Read More</a>
            </div>
            <div class='panel-footer'>
                Posted by {{ $post->author }} on {{ date('D M d, Y', $post->post_timestamp) }}
            </div>
        </div>
        @endif
    @endforeach
    {!! $posts->render() !!}
@endsection