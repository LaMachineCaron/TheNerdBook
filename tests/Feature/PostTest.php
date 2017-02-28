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
}
