@extends('public/main')

@section('title')
Home
@endsection

@section('content')
    <div class='panel panel-info'>
        <div class='panel-heading'>
            Welcome
        </div>
        <div class='panel-body'>
            Hey there! Welcome to our brand new website! We've introduced a new news feed, new billing interface, and a better support interface.<br>
            We hope you enjoy these changes, <a href="/blog">click here</a> to read our new news and blog feed!<br>
        </div>
        <div class='panel-footer'>
            Last updated 4/13/2016
        </div>
    </div>
@endsection