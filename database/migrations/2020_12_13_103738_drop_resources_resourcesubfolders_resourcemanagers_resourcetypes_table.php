<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropResourcesResourcesubfoldersResourcemanagersResourcetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('resources');

        Schema::dropIfExists('resourcesubfolders');

        Schema::dropIfExists('resource_managers');

        Schema::dropIfExists('resourcetypes');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
