@extends('layouts.blog')

@section('title')
	블로그를 자세하게 
@endsection

@section('content')
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    <a href="{{ url('/posts') }}">목록</a>
    <a href="{{ url('/posts/'.$post->id.'/edit') }}">수정</a>
    <!-- last updated at: {{ $post->updated_at }} -->
@endsection