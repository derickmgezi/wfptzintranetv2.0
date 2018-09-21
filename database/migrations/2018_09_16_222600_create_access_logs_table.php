<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('access_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user')->nullable();
            $table->text('link_accessed');
            $table->string('action_taken');
            $table->text('action_details');
            $table->string('action_status')->default('Success');
            $table->string('link_type')->default('Internal');
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
        Schema::dropIfExists('access_logs');
    }
}
