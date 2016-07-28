@extends('layouts.blog')

@section('title')
블로그를 풍부하게
@endsection

@if (count($errors) > 0)
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach
    </ul>
@endif

@section('content')
    @foreach($posts as $post)
    <form action="{{ url('posts/'.$post->id) }}" method="post">
        {{ @csrf_field() }}
        {{ method_field('PUT') }}
        <table>
            <tbody>
                <tr>
                    <th><label for="">제목</label></th>
                    <td><input type="text" name="title" value="{{ $post->title }}"></td>
                </tr>
                <tr>
                    <th><label for="">내용</label></th>
                    <td><textarea name="body" id="" cols="30" rows="10">{{ $post->body }}</textarea></td>
                </tr>
                <tr>
                    <th><button type="submit">글쓰기</button></th>
                    <td><a href="{{ url('posts') }}">취소</a></td>
                </tr>
            </tbody>
        </table>
    </form>
    @endforeach
@endsection