<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonedirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phonedirectories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('function',100);
            $table->string('department',100);
            $table->string('ext_no',10)->unique()->nullable();
            $table->string('number',20)->unique()->nullable();
            $table->string('location',100);
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
        Schema::dropIfExists('phonedirectories');
    }
}
