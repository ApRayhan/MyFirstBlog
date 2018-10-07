<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::all();
        $posts = Post::latest()->status()->Is_Approved()->take(6)->get();
        return view('welcome', compact('categorys', 'posts'));
    }
}
