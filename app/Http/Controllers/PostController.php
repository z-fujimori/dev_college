<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    //
    public function index(Post $post)
    {
        return view('dashboard')->with(['posts' => $post->orderBy('updated_at', 'DESC')->get()]);
    }
    
    public function store(PostRequest $request, Post $post)
    {
        // $validated = $request->validate([
        //     'title' => 'required|string|max:5',
        //     'body' => 'required|string|max:200',
        // ],
        // [
        //     // 'title.required' => 'タイトルは必須です。',
        //     'title.max:5' => '文字数上限は50文字です。',
        //     'body.required' => 'bodyは必須項目です。',
        // ]);
        
        $input = $request['post'];
        $input += ["user_id"=>auth()->user()->id];
        // $post->fill($input)->save();
        $post->create($input);
        return redirect('/dashboard');
    }
}
