<?php
/**
 * Created by PhpStorm.
 * User: marcopolo
 * Date: 2017-02-23
 * Time: 1:47 PM
 */

namespace App\Models;


use App\User;

class PostLike
{
    protected $table = 'post_likes';

    public function comment() {
        return $this->belongsTo(Post::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}