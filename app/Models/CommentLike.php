<?php
/**
 * Created by PhpStorm.
 * User: marcopolo
 * Date: 2017-02-23
 * Time: 1:41 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentLike extends Model
{
    protected $table = 'comment_likes';

    public function comment() {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function user(){
        return $this->belongsTo(\App\User::class, 'user_id');
    }
}