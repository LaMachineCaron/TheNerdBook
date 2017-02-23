<?php
/**
 * Created by PhpStorm.
 * User: marcopolo
 * Date: 2017-02-23
 * Time: 1:41 PM
 */

namespace App\Models;


use App\User;

class CommentLike
{
    protected $table = 'comment_likes';

    public function comment() {
        return $this->belongsTo(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}