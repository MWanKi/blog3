<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

use App\Comment;

use Validator;

class CommentController extends Controller
{
    function store($post_id, Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'required|max:255',
            'body' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('posts/'.$post_id)
                    ->withErrors($validator)
                    ->withInput();
        } else {
	    	$post = Post::where('deleted', false)->find($post_id);

	    	$comment = new Comment;
	    	$comment->post_id = $post_id;
	    	$comment->name = $request->name;
	    	$comment->password = $request->password;
	    	$comment->body = $request->body;
	    	$comment->save();

	    	return redirect('/posts/'.$post_id);
	    }
    }
}
