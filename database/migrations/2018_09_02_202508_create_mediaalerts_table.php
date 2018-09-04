<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaalertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mediaalerts', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->text('header');
            $table->string('mediacontent');
            $table->string('type');
            $table->string('source');
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->timestamps();
            
            //foreign keys
            $table->foreign("created_by")
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
    public function down()
    {
        Schema::dropIfExists('mediaalerts');
    }
}
