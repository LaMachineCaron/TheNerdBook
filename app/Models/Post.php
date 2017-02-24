<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\User;

class Post extends Model
{
    protected $table = 'posts';
    
	public function user() {
    	return $this->belongsTo(\App\User::class);
    }
    
	public function comments() {
    	return $this->hasMany(Comment::class, 'post_id');
    }
    
    public function likes() {
    	return $this->hasMany(PostLike::class, 'post_id');
    }
}
