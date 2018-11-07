<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuebookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venuebookings', function (Blueprint $table) {
            $table->increments('id');
            $table->text('purpose');
            $table->string('location', 40);
            $table->string('venue', 40);
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->smallInteger('participants');
            $table->string('requirebeverages', 3);
            $table->text('beverageoptions')->nullable();
            $table->integer('created_by')->unsigned();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('venuebookings');
    }
}
