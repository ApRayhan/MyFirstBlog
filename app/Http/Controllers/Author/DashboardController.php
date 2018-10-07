<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
    	$posts = $user->posts;
    	$top_posts = $user->posts()
    					->withCount('comments')
    					->withCount('favorite_to_users')
    					->orderBy('view_count', 'desc')
    					->orderBy('comments_count')
    					->orderBy('favorite_to_users_count')
    					->take(3)
    					->get();
    	$panding_post = $posts->where('is_approved', false)->count();
    	$total_view = $posts->sum('view_count');

    	return view('author.dashboard', compact('user', 'posts', 'top_posts', 'panding_post', 'total_view'));
    }
}
