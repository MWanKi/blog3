@extends('layouts.blog')

@section('title')
블로그를 새롭게
@endsection

@section('content')
    <ul>
        @foreach($posts as $post)
            <li id="post-{{ $post->id }}">
                <a href="{{ url('posts/'.$post->id) }}">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->body }}</p>
                    <a href="{{ url('posts/'.$post->id) }}" data-csrf-token="{{ csrf_token() }}" data-confirm="정말 지우시겠습니까?" class="delete-link-ajax">Ajax삭제</a>
                    <a href="{{ url('posts/'.$post->id) }}" data-csrf-token="{{ csrf_token() }}" data-confirm="정말 지우시겠습니까?" class="delete-link">삭제</a>
                    <form action="{{ url('posts/'.$post->id) }}" method="post" class="delete-post">
                        {{ method_field('DELETE') }}
                        {{ @csrf_field() }}
                        <button type="submit">삭제하기</button>
                    </form>
                </a>
                <hr>
            </li>
        @endforeach
    </ul>
    <a href="{{ url('posts/create') }}">글쓰자</a>
<!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.0.0/turbolinks.min.js"></script>
-->
    <script   src="https://code.jquery.com/jquery-1.12.4.min.js"   integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="   crossorigin="anonymous"></script>
    <script>
        // $(document).on('click', 'a', function() {
        //     var url = $(this).attr('href');
        //     $.get(url, {xhr: 'true'}).done(function(data) {
        //         $('body').html(data)
        //     });
        //     return false;
        // });
        $(document).on("submit",".delete-post",function(){
            return confirm('정말 지우시겠습니까?');
        });
        $(document).on('click', '.delete-link', function() {
            if (!confirm($(this).data('confirm'))) {
                return false;
            }
            var url = $(this).attr('href');
            var csrfToken = $(this).data('csrfToken');
            var csrfInput = $('<input>').attr({
                type: 'hidden',
                name: '_token',
                value: csrfToken
            });
            var methodInput = $('<input>').attr({
                type: 'hidden',
                name: '_method',
                value: 'delete'
            });
            var form = $('<form>').attr({
                action: url,
                method: 'post'
            }).append(methodInput).append(csrfInput).appendTo($('body'));
            form.submit();
            return false;
        });
        $(document).on('click', '.delete-link-ajax', function() {
            if (!confirm($(this).data('confirm'))) {
                return false;
            }
            var url = $(this).attr('href');
            var csrfToken = $(this).data('csrfToken');
            $.ajax({
                type: 'delete',
                url: url,
                data: {
                    _token: csrfToken,
                    xhr: 'true'
                }
            }).done(function(data) {
                $('#post-' + data).slideUp(function () {
                    $(this).remove();
                });
            }).error(function() {
                alert('삭제 실패');
            });
            return false;
        });
    </script>
@endsection