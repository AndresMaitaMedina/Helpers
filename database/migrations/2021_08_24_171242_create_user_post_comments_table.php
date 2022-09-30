<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPostCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_post_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('use_id');
            $table->unsignedBigInteger('pos_id');
            $table->boolean('use_pos_like')->default(false);
            $table->foreign('use_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pos_id')->references('id')->on('Post_comments')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_post_comments');
    }
}
