<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index() {

        $search = request()->input('search');
        $search_type = request()->input('search_type');
        $sort = request()->input('sort', 'newest');
    
        $query = Post::query();
    
        if (!empty($search)) {
            switch ($search_type) {
                case 'prefix':
                    $query->where('title', 'like', $search . '%');
                    break;
                case 'suffix':
                    $query->where('title', 'like', '%' . $search);
                    break;
                case 'partial':
                default:
                    $query->where('title', 'like', '%' . $search . '%');
                    break;
            }
        }
    
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'ASC');
                break;
            case 'title_asc':
                $query->orderBy('title', 'ASC');
                break;
            case 'title_desc':
                $query->orderBy('title', 'DESC');
                break;
            case 'newest':
            default:
                $query->orderBy('created_at', 'DESC');
                break;
        }
    
        $posts = $query->paginate(3);
    
        return view('posts.index', compact('posts'));
    }


    public function create() {

        if(!Auth::check()){

            return redirect()->route('login');
        }

        return view('posts.create');
    }

    public function store(Request $request) {

        if(!Auth::check()){

            return redirect()->route('login');
        }


        $validator = Validator::make($request->all(), [

            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }

       
        $post = new Post();

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect()->route('posts.show', compact('post'));
    }


    public function show(Post $post) {

       $post = $post->load('comments.user');

       $comments = $post->comments()->paginate(10);
        


        return view('posts.show', compact('post', 'comments'));
    }

    public function edit(Post $post) {
        
        if(Auth::user()->id != $post->user_id) {

            return redirect()->route('posts.index');
        }


        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post){

                
        if(Auth::user()->id != $post->user_id) {

            return redirect()->route('posts.index');
        }
        
        $validator = Validator::make($request->all(), [

            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        if($validator->fails()){

            return redirect()->back()->withInput()->withErrors($validator);
        }


        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', compact('post'));
    }

    public function destroy(Post $post) {

                
        if(Auth::user()->id != $post->user_id) {

            return redirect()->route('posts.index');
        }

        $post->delete();

        return redirect()->route('posts.index');
    }

}
