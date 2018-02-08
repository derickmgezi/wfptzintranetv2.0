<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonebillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phonebill', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('ext_no', 8);
            $table->string('user_name',40);
            $table->string('line', 10);
            $table->string('type', 10)->nullable();
            $table->string('number',15);
            $table->dateTimeTz('date_time');
            $table->string('duration', 10);
            $table->integer('cost');
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phonebill');
    }
}
