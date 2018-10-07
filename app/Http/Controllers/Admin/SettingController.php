<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingController extends Controller
{
    public function index()
    {
    	return view('admin.setting.index');
    }
    public function update(Request $request)
    {
    	$this->validate($request, [
    		'name'  => 'required',
    		'email' => 'required|email',
    		'image' => 'required'
    	]);
    	// Take the image From image fild

    	$image = $request->file('image');
    	$slug  = str_slug($request->name);
    	$user = User::findOrFail(Auth::id());

    	// Check The image is exists or not
    	if (isset($image)) {
    		$time = Carbon::now()->toDateString();
    		$imagename = $slug . '-' . $time . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
    		// Make sure the image folder is Exists or not if not exists then create a new folder

    		if (!Storage::disk('public')->exists('profileimg')) {
    			Storage::disk('public')->makeDirectory('profileimg');
    		}
    		// Delete The old image from Storage
    		if (Storage::disk('public')->exists('profileimg/'.$user->image)) {
    			Storage::disk('public')->delete('profileimg/'.$user->image);	
    		}

    		$profileimage = Image::make($image)->resize(500, 500)->save($image->getClientOriginalExtension());
    		Storage::disk('public')->put('profileimg/'. $imagename, $profileimage);

    	}else {
    		$imagename = Auth::user()->image;
    	}
    	$user = Auth::user();
    	$user->name = $request->name;
    	$user->email = $request->email;
    	$user->about = $request->about;
    	$user->image = $imagename;
    	$user->save();

    	Toastr::success('profile Successfully Updated ;)', 'Success Msg');
    	return redirect()->back();


    }
    public function changepassword(Request $request)
    {
    	$this->validate($request, [
    		'old_password' => 'required',
    		'password'     => 'required|confirmed'
    	]);

    	$password = Auth::user()->password;

    	if (Hash::check($request->old_password, $password)) {
    		if (!Hash::check($request->password, $password)) {
    			$user = User::find(Auth::id());
    			$user->password = Hash::make($request->password);
    			$user->save();
    			Toastr::success('Your Password Is Successfully Changed ', 'Success');
    			Auth::logout();
    			return redirect()->back();
    		}
    		else {
    			Toastr::error('The New password Cannot Be Match Be the New password ', 'Error');
    			return redirect()->back();
    		}
    	} 
    	else {
    		Toastr::error('The Old password Do not Match ' , 'Error');
    		return redirect()->back();
    	}
    }
}
