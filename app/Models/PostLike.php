<?php
/**
 * Created by PhpStorm.
 * User: marcopolo
 * Date: 2017-02-23
 * Time: 1:47 PM
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PostLike extends Model
{
    protected $table = 'post_likes';

    public function post() {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}