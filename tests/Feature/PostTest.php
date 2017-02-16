<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostTest extends TestCase
{
    /**
     * Check if the table exist.
     *
     * @test
     */
    public function check_table_posts()
    {
        $this->assertTrue(Schema::hasTable('posts'), "'posts' table didn't exist.");
    }

    /**
     * Check if it's possible to save a post model in the database.
     *
     * @test
     */
    public function save_post_model()
    {
        $post = new Post;
        $post->user_id = 1;
        $post->content = "Ce vidéo est trop cool!!!";
        $post->url = "https://www.youtube.com";
        $post->likes = 42;
        $this->assertTrue($post->save());
        $this->seeInDatabase('posts', [
            'user_id' => $post->user_id,
            'content' => $post->content,
            'url' => $post->url,
            'likes' => $post->likes,
        ]);
    }
}
