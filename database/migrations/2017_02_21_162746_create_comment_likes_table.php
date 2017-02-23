<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("comment_id");
            $table->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedInteger("user_id");
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('content');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_likes');
    }
}
