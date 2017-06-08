<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('header');
            $table->text('description');
            $table->text('story');
            $table->string('type',10);
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->integer('created_by',10);
            $table->integer('edited_by',10);
            $table->timestamps();

            //foreign keys
            $table->foreign("created_by")
                   ->references("id")
                   ->on("users")
                   ->onDelete("cascade")
                   ->onUpdate("cascade");
            
            $table->foreign("edited_by")
                   ->references("id")
                   ->on("users")
                   ->onDelete("cascade")
                   ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('posts');
    }

}
