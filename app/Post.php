<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function tags()
    {
    	return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function categorys()
    {
    	return $this->belongsToMany('App\Category')->withTimestamps();
    }
    public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }
    public function scopeIs_Approved($query)
    {
        return $query->where('is_approved', 1);
    }
}
