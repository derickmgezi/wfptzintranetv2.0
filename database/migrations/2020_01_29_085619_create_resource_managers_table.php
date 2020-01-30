<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_managers', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user')->unsigned();
            $table->integer('resource_type')->unsigned();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->integer('edited_by')->unsigned();
            $table->timestamps();

            //unique key
            $table->unique(array("user","resource_type"));

            //foreign keys
            $table->foreign("user")
            ->references("id")
            ->on("users")
            ->onDelete("cascade")
            ->onUpdate("cascade");

            $table->foreign("resource_type")
            ->references("id")
            ->on("resourcetypes")
            ->onDelete("cascade")
            ->onUpdate("cascade");

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
        Schema::dropIfExists('resource_managers');
    }
}
