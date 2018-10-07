<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
   public function add($id)
   {
   		$user = Auth::user();
   		$userFavorite = $user->favorite_posts()->where('post_id', $id)->count();

   		if ($userFavorite == 0) {
   			$user->favorite_posts()->attach($id);
   			Toastr::success('The Post Is SuccessFully added To Your Favorite List', 'SuccessMsg');
   			return redirect()->back(); 
   		} else {
   			$user->favorite_posts()->detach($id);
   			Toastr::success('The Post Is SuccessFully Remove From Your Favorite List', 'SuccessMsg');
   			return redirect()->back(); 
   		}

   }
}
