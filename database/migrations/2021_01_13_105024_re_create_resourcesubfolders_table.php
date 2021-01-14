<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReCreateResourcesubfoldersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resourcesubfolders', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('id');
            $table->text('subfolder_name')->nullable();
            $table->integer('position');
            $table->bigInteger('resource_type_id')->unsigned();
            $table->boolean('status')->default(1);
            $table->integer('created_by')->unsigned();
            $table->integer('edited_by')->unsigned();
            $table->string('image')->nullable();
            $table->timestamps();

             //foreign keys
             $table->foreign("resource_type_id")
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
        Schema::dropIfExists('resourcesubfolders');
    }
}
