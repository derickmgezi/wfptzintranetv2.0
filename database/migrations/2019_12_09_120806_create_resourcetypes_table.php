<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resourcetypes', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('resource_type',20)->unique();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->integer('edited_by')->unsigned();
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
    public function down()
    {
        Schema::dropIfExists('resourcetypes');
    }
}
