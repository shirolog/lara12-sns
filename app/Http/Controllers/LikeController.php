<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
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

        return redirect()->back();
    }
}
