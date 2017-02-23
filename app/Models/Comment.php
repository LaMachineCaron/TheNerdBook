<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    
    public function user() {
    	return $this->belongsTo(User::class);
    }
    
	public function post() {
    	return $this->belongsTo(Post::class);
    }

    public function comment() {
        return $this->HasMany(CommentLike::class);
    }
}
