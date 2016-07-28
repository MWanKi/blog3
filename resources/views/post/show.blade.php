@extends('layouts.blog')

@section('title')
	블로그를 자세하게 
@endsection

@section('content')
    <h2>{{ $post->title }}</h2>
    <p>{{ $post->body }}</p>
    <!-- last updated at: {{ $post->updated_at }} -->
	<hr>
	@if (count($errors) > 0)
		<ul>
			@foreach($errors->all() as $error)
				<li> {{ $error }} </li>
			@endforeach
		</ul>
	@endif

    <form action="{{ url('/posts/'.$post->id.'/comments') }}" method="post">
    	{{ @csrf_field() }}
    	<div>
    		<label for="comment-name">이름</label>
    		<input type="text" name="name" id="comment-name">
    	</div>
    	<div>
    		<label for="comment-password">암호</label>
    		<input type="password" name="password" id="comment-password">
    	</div>
    	<div>
    		<label for="comment-body">댓글내용</label>
			<textarea name="body" id="comment-body" cols="30" rows="3"></textarea><br>
		</div>
		<button type="submit">댓글등록</button>
    </form>
    @foreach($post->comments as $comment)
    	<div>
    		{{ $comment->name }}
    		{{ $comment->body }}
    	</div>
    @endforeach
    <hr>
    <a href="{{ url('/posts') }}">목록</a>
    <a href="{{ url('/posts/'.$post->id.'/edit') }}">수정</a>
@endsection