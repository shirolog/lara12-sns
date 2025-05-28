<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(Request $request, Post $post) {

        $validator = Validator::make($request->all(), [

            'content' => 'required|max:500',
        ]);

        if($validator->fails()) {

            return redirect()->back()->withInput()->withErrors($validator);
        }
        
        $comment = new Comment();

        $comment-> post_id = $post->id;
        $comment-> user_id = Auth::user()->id;
        $comment-> content = $request->input('content');
        $comment->save();


        return redirect()->route('posts.show', $post->id);

    }
}
