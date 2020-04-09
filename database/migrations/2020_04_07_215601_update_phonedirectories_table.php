<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdatePhonedirectoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Give the moving column a temporary name: in this case location to location_old
        Schema::table('phonedirectories', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->renameColumn('number', 'official_mobile_no');
            $table->renameColumn('location', 'location_old');
            $table->string('personal_mobile_no', 20)->unique()->nullable()->after('number');
            $table->string('status',10)->default('active')->after('personal_mobile_no');
        });

        //Add a new column with the regular name: duty_station
        Schema::table('phonedirectories', function (Blueprint $table) {
            $table->string('duty_station', 100)->after('department');
        });

        //Copy the data across to the new column:
        DB::table('phonedirectories')->update([
            'duty_station' => DB::raw('location_old')   
        ]);

        //Remove the old column:
        Schema::table('phonedirectories', function (Blueprint $table) {
            $table->dropColumn('location_old');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phonedirectories', function (Blueprint $table) {
            //
        });
    }
}
