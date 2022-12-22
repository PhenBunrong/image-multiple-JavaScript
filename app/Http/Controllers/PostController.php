<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('post.index',compact('posts'));
    }

    public function store(Request $request)
    {
        $post = Post::create([
            'name' => $request->name
        ]);

        $post->tags()->create([
            'name' => $request->name
        ]);
    }

    public function update()
    {
        $post = Post::find(1);	
 
        $tag1 = new Tag;
        $tag1->name = "Lofoe1sdksdkwkkk.com";
        
        $tag2 = new Tag;
        $tag2->name = "Lofoe1sdksdkwkkk.com 2";
        
        $post->tags()->saveMany([$tag1, $tag2]);
    }

    public function destroy()
    {
        $post = Post::find(5);

        $post->tags()->delete();

        $post->delete();
    }
}
