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
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->text('header');
            $table->text('description');
            $table->text('story');
            $table->string('type',10);
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->integer('created_by');
            $table->integer('edited_by');
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
