<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use Validator;

class PostController extends Controller
{
    function index() {
    	$posts = Post::where('deleted', false)
    				->orderBy('created_at', 'desc')
    				->get();

    	return view('post.index', [
    		'posts' => $posts
    	]);
    }

    function create() {
    	return view('post.create');
    }

    function store(Request $request) {

    	$validator = Validator::make($request->all(), [
    		'title' => 'required|unique:posts|max:255',
    		'body' => 'required',
		]);

		if ($validator->fails()) {
			return redirect('posts/create')
					->withErrors($validator)
					->withInput();
		} else {
			$post = new Post;
	    	$post->title = $request->title;
	    	$post->body = $request->body;
	    	$post->save();

	    	return redirect('/posts');
		}
    }

	
    function show() 
    {
    	$id = str_replace('/posts/', '', $_SERVER['REQUEST_URI']);
    	$post = Post::find($id);

    	return view('post.show', [
    		'post' => $post
    	]);
    }

    function edit() 
    {
        $id = str_replace('/posts/', '', $_SERVER['REQUEST_URI']);
        $posts = Post::where('id', $id)
                    ->get();

        return view('post.edit', [
            'posts' => $posts
        ]);

    }

    function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('posts/'.$id.'/edit')
                    ->withErrors($validator)
                    ->withInput();
        } else {
            $post = Post::find($id);
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();

            return redirect('/posts');
        }
    }

}
