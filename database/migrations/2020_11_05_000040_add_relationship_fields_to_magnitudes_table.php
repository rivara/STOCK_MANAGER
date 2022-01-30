<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMagnitudesTable extends Migration
{
    public function up()
    {
        Schema::table('magnitudes', function (Blueprint $table) {
            $table->unsignedInteger('idunit_id')->nullable();
            $table->foreign('idunit_id', 'idunit_fk_2527961')->references('id')->on('units');
        });
    }
}
