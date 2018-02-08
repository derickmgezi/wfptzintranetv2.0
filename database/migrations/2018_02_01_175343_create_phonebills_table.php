<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonebillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phonebills', function (Blueprint $table) {
            // Convert table to use InnoDB
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('ext_no', 8);
            $table->string('user_name',40);
            $table->string('line', 10);
            $table->string('type', 10)->nullable();
            $table->string('number',20);
            $table->dateTimeTz('date_time');
            $table->string('duration', 10);
            $table->integer('cost');
            $table->timestamps();
            
            //unique key
            $table->unique(array("ext_no","line","number","date_time","duration","cost"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phonebills');
    }
}
