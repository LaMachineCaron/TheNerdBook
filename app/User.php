<?php

namespace App;

use App\Models\CommentLike;
use App\Models\PostLike;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\This;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
    	'last_name',
    	'email',
    	'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    	'remember_token',
    ]; 
    
    public function followers() {
    	return $this->belongsToMany(User::class, 'follows', 'user_id', 'follower_id');
    }
    
    public function following() {
    	return $this->belongsToMany(User::class, 'follows', 'follower_id', 'user_id');
    }
    
	public function comments() {
    	return $this->hasMany(Comment::class);
    }
    
    public function posts() {
    	return $this->hasMany(Post::class);
    }

    public function getAccessTokenYoutube() {
        return $this->access_token_youtube;
    }

    public function setAccessTokenYoutube(array $access_token) {
        $this->access_token_youtube = $access_token;
    }

    public function getAccessTokenTwitch() {
        return $this->access_token_twitch;
    }

    public function setAccessTokenTwitch(String $access_token) {
        $this->access_token_twitch = $access_token;
    }

    public function comment_like(){
        return $this->hasMany(CommentLike::class, 'user_id');
    }

    public function post_like(){
        return $this->hasMany(PostLike::class, 'user_id');
    }
}
