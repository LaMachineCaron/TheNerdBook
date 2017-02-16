<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $table = 'posts';
    
	public function user() {
    	return $this->belongsTo(User::class);
    }
    
	public function comments() {
    	return $this->hasMany(Comment::class);
    }
}
