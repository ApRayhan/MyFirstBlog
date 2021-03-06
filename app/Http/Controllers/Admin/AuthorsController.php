<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    public function index()
    {
    	$authors = User::authors()
	    	->withCount('posts')
	    	->withCount('comments')
	    	->withCount('favorite_posts')
	    	->get();
	    	return view('admin.authors', compact('authors'));
    }

    public function destroy($id)
    {
    	User::findOrFail($id)->delete();
        return redirect()->back();
        Toastr::success('User SuccessFully Deleted :)', 'successmsg');
    }
}
