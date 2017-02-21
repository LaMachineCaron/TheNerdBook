<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommentTest extends TestCase
{
    /**
     * Check if the table exist.
     *
     * @test
     */
    public function check_table_comments()
    {
        $this->assertTrue(Schema::hasTable('comments'), "'comments' table didn't exist.");
    }

    /**
     * Check if it's possible to save a comment model in the database.
     *
     * @test
     */
    public function save_comment_model()
    {
        $comment = new Comment;
        $comment->user_id = 1;
        $comment->post_id = 1;
        $comment->content = "Hahaha j'adore!!!";
        $this->assertTrue($comment->save());
        $this->assertDatabaseHas('comments', [
            'user_id' => $comment->user_id,
            'post_id' => $comment->post_id,
            'content' => $comment->content,
        ]);
    }
}
