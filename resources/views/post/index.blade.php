@extends('layouts.blog')

@section('title')
블로그를 새롭게
@endsection

@section('content')
    <ul>
        @foreach($posts as $post)
            <li>
                <a href="{{ url('posts/'.$post->id) }}">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                </a>
                <hr>
            </li>
        @endforeach
    </ul>
    <a href="{{ url('posts/create') }}">글쓰자</a>
@endsection