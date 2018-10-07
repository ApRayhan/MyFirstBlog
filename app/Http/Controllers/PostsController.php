<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::latest()->status()->Is_Approved()->paginate(2);

    	return view('posts', compact('posts'));
    }
}
