<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncidenciaidToRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('records', function(Blueprint $table) {
            //
			
			$table->unsignedInteger('actuacion_id')->after('idrecord')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function(Blueprint $table) {
            //
			$table->dropColumn('actuacion_id');
        });
    }
}
