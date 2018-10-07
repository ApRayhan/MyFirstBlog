<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
    	$posts = Post::all();
    	$user = User::where('roll_id', 2)->get();
    	$comment = Comment::all();
    	$today_user = User::where('created_at', Carbon::today())->get();
    	$top_posts = Post::withCount('comments')
    					  ->withCount('favorite_to_users')
    					  ->orderBy('view_count', 'desc')
    					  ->orderBy('comments_count', 'desc')
    					  ->orderBy('favorite_to_users_count', 'desc')
    					  ->take(4)->get();
    	$panding_post = Post::where('is_approved', false)->get();
    	$total_view = $posts->sum('view_count');
    	$category = Category::all();
    	return view('admin.dashboard', compact('posts', 'user', 'comment', 'today_user', 'top_posts', 'panding_post', 'total_view', 'category'));
    }
}
