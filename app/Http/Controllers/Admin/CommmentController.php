<?php

namespace App\Http\Controllers\admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommmentController extends Controller
{
    public function index()
    {
    	$comments = Comment::latest()->get();

    	return view('admin.comment', compact('comments'));
    }

    public function destroy($id)
    {
       $comment = Comment::findOrFail($id)->delete();

       Toastr::success('Comment SuccessFullly Deleted', 'SuccessMessage');
       return redirect()->back();
    }
}
