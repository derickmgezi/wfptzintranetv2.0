<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEditorTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('editors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('editor')->unsigned();
            $table->string('function', 40);
            $table->boolean('status')->default(1);
            $table->timestamps();
            
            //foreign keys
            $table->foreign("editor")
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
        Schema::dropIfExists('editors');
    }

}
