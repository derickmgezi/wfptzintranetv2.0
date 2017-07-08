<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('likes', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->integer('view_id')->unsigned();
            $table->integer('liked_by')->unsigned();
            $table->timestamps();

            //foreign keys
            $table->foreign("liked_by")
                   ->references("id")
                   ->on("users")
                   ->onDelete("cascade")
                   ->onUpdate("cascade");
            
            $table->foreign("view_id")
                   ->references("id")
                   ->on("news")
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
        Schema::dropIfExists('likes');
    }

}
