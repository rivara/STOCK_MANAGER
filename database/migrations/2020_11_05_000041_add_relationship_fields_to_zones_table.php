<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToZonesTable extends Migration
{
    public function up()
    {
        Schema::table('zones', function (Blueprint $table) {
            $table->unsignedInteger('network_id');
            $table->foreign('network_id', 'network_fk_2527854')->references('id')->on('networks');
        });
    }
}
