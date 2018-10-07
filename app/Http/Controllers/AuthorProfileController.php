<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthorProfileController extends Controller
{
    public function profile($user_name)
    {
    	$user = User::where('user_name', $user_name)->first();
    	$posts = $user->posts()->status()->is_approved()->get();

    	return view('profile', compact('user', 'posts'));
    }
}
