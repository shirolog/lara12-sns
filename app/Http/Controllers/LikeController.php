<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Notifications\LikeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleLike(Request $request, Post $post) {

        if(!Auth::check()) {

            return redirect()->route('login');
        }

        $user = Auth::user();
        
        $liked = Like::where('post_id', $post->id)
            ->where('user_id', $user->id)
            ->first();

        if($liked) {

            $liked->delete();

        } else {
            
            $like = new Like();
            $like->user_id = $user->id;
            $like->post_id = $post->id;
            $like->save();

        }

        return response()->json([

            'liked' => !$liked, //いいねは最初falseの状態にしておきたい
            'like_count' => Like::where('post_id', $post->id)->count(),
        ]);
    }
}
