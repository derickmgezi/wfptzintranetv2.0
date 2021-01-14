<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReCreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->string('resource_name');
            $table->integer('position');
			$table->bigInteger('subfolder_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->text('resource_location');
			$table->string('external_link', 3)->default('No');
            $table->integer('uploaded_by')->unsigned();
            $table->integer('edited_by')->unsigned();
			$table->string('image')->nullable();
            $table->timestamps();

            //foreign keys
			$table->foreign("subfolder_id")
                   ->references("id")
                   ->on("resourcesubfolders")
                   ->onDelete("cascade")
                   ->onUpdate("cascade");
			
            $table->foreign("uploaded_by")
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
        Schema::dropIfExists('resources');
    }
}

