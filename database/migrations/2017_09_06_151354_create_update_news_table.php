<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUpdateNewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        //
        Schema::table('news', function($table) {
            $table->string('office', 40)->default('CO')->after('type');
            $table->integer('authorized_by')->nullable()->unsigned()->after('office');
            $table->timestamp('authorized_at')->nullable()->after('authorized_by');
            $table->boolean('authorization_status')->default(1)->after('authorized_at');
            
            //foreign keys
            $table->foreign("authorized_by")
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
    public function down() {
        //
    }

}
