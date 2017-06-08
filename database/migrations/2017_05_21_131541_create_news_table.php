<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('news', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->text('header');
            $table->string('image');
            $table->text('description');
            $table->text('story');
            $table->string('source',50);
            $table->string('type',10);
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
        Schema::dropIfExists('news');
    }

}
