<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index($slug)
    {
    	$posts = Post::where('slug', $slug)->first();
    	$blogkey = 'blog_'. $posts->id;

    	if(!Session::has($blogkey))
    	{
    		$posts->increment('view_count');
    		Session::put($blogkey, 1);
    	}
    	$randomposts = Post::status()->Is_Approved()->take(3)->inRandomOrder()->get();

    	return view('post', compact('posts', 'randomposts'));
    }
    public function postByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->status()->Is_Approved()->get();
        return view('category_post', compact('posts'));

    }
    public function postBytag($slug)
    {
        $tags = Tag::where('slug', $slug)->first();
        $posts = $tags->posts()->status()->Is_Approved()->get();
        return view('tag_post', compact('posts'));
    }
}
