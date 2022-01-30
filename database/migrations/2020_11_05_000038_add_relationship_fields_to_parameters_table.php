<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToParametersTable extends Migration
{
    public function up()
    {
        Schema::table('parameters', function (Blueprint $table) {
            $table->unsignedInteger('idmagnitude_id');
            $table->foreign('idmagnitude_id', 'idmagnitude_fk_2527968')->references('id')->on('magnitudes');
            $table->unsignedInteger('technique_id');
            $table->foreign('technique_id', 'technique_fk_2527976')->references('id')->on('techniques');
            $table->unsignedInteger('unit_id')->nullable();
            $table->foreign('unit_id', 'unit_fk_2527977')->references('id')->on('units');
            $table->unsignedInteger('calculation_id');
            $table->foreign('calculation_id', 'calculation_fk_2527978')->references('id')->on('calculations');
            $table->unsignedInteger('location_id');
            $table->foreign('location_id', 'location_fk_2527980')->references('id')->on('asset_locations');
            $table->unsignedInteger('asset_id')->nullable();
            $table->foreign('asset_id', 'asset_fk_2527981')->references('id')->on('assets');
        });
    }
}
