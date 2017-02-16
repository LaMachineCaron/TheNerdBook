<?php

use Illuminate\Database\Seeder;

use App\Models\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();

        for ($i=0; $i < 2; $i++) {
        	factory(Comment::class)->create();
        }
    }
}
