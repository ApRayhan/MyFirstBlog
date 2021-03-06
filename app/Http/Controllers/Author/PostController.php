<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Http\Controllers\Controller;
use App\Notifications\Newpostmail;
use App\Post;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->latest()->get();
        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        $tags = Tag::all();
        return view('author.post.create', compact('categorys', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'image' => 'required'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) 
        {
            // Make A Uniq Name For image
            $date = Carbon::now()->toDateString();
            $imagename = $slug. '-'. $date. '-'. uniqid(). '.'. $image->getClientOriginalExtension();
            // Check The Post Folder is Exists Or Not
            if (!Storage::disk('public')->exists('post')) 
            {
                Storage::disk('public')->makeDirectory('post');
            }
            // Resize The image
            $postimg = Image::make($image)->resize(1600, 1066)->save($image->getClientOriginalExtension());
            // Move This image to The post Directory
            Storage::disk('public')->put('post/'.$imagename, $postimg );
        } else
        {
            $imagename = 'default.png';
        }

        // Save All Data To The Database
        $post = New Post();
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->body = $request->body;
        $post->image = $imagename;
        if (isset($request->status)) 
        {
            $post->status = true;   
        } else 
        {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categorys()->attach($request->category);
        $post->tags()->attach($request->tags);
        $user = User::where('roll_id', '1')->get();
        Notification::send($user , new Newpostmail($post));

        Toastr::success('Post SuccessFully Added :) ', 'successMsg');

        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user_id != Auth::id() ) {
            Toastr::info('You Dont have Any permission to Excess the post ', 'msg');
            return redirect()->back();
        }
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id != Auth::id() ) {
            Toastr::info('You Dont have Any permission to Excess the post ', 'msg');
            return redirect()->back();
        }
        $categorys = Category::all();
        $tags = Tag::all();
        return view('author.post.edit', compact('categorys', 'tags', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'body' => 'required',
            'image' => 'image'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        if (isset($image)) 
        {
            // Make A Uniq Name For image
            $date = Carbon::now()->toDateString();
            $imagename = $slug. '-'. $date. '-'. uniqid(). '.'. $image->getClientOriginalExtension();
            // Check The Post Folder is Exists Or Not
            if (!Storage::disk('public')->exists('post')) 
            {
                Storage::disk('public')->makeDirectory('post');
            }
            // Delete post old image
            if (Storage::disk('public')->exists('post/'.$post->image)) 
            {
                Storage::disk('public')->delete('post/'.$post->image);
            }
            // Resize The image
            $postimg = Image::make($image)->resize(1600, 1066)->save($image->getClientOriginalExtension());
            // Move This image to The post Directory
            Storage::disk('public')->put('post/'.$imagename, $postimg );
        } else
        {
            $imagename = $post->image;
        }

        // Save All Data To The Database
        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->body = $request->body;
        $post->image = $imagename;
        if (isset($request->status)) 
        {
            $post->status = true;   
        } else 
        {
            $post->status = false;
        }
        $post->is_approved = false;
        $post->save();

        $post->categorys()->sync($request->category);
        $post->tags()->sync($request->tags);

        Toastr::success('Post SuccessFully Updated :) ', 'successMsg');

        return redirect()->route('author.post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id != Auth::id() ) {
            Toastr::info('You Dont have Any permission to Excess the post ', 'msg');
            return redirect()->back();
        }
        if (Storage::disk('public')->exists('post/'.$post->image)) 
        {
            Storage::disk('public')->delete('post/'.$post->image);
        }

        $post->categorys()->detach();
        $post->tags()->detach();
        $post->delete();

        Toastr::success('Post SuccessFully Deleted :) ', 'success');

        return redirect()->back();
    }
}
