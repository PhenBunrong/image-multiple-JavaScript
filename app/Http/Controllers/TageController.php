<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class TageController extends Controller
{
    public function index()
    {
        $post = Post::first();

        return $post;
    }
}
