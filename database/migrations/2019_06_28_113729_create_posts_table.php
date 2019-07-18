<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("user_id")->unsigned();
            $table->string("title");
            $table->string('slug')->unique();
            $table->text("description");
            $table->text("image")->default('default.png');
            $table->integer('view_count')->default(0);
            $table->boolean('status')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');;
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
        Schema::dropIfExists('posts');
    }
}
