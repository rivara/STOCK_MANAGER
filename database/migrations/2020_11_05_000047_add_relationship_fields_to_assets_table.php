<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssetsTable extends Migration
{
    public function up()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->nullable();
            $table->foreign('category_id', 'category_fk_2527819')->references('id')->on('asset_categories');
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_2527823')->references('id')->on('asset_statuses');
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_2527824')->references('id')->on('asset_locations');
            $table->unsignedInteger('assigned_to_id')->nullable();
            $table->foreign('assigned_to_id', 'assigned_to_fk_2527826')->references('id')->on('users');
            $table->unsignedInteger('mark_id')->nullable();
            $table->foreign('mark_id', 'mark_fk_2527903')->references('id')->on('marks');
            $table->unsignedInteger('sample_id')->nullable();
            $table->foreign('sample_id', 'sample_fk_2527904')->references('id')->on('samples');
            $table->unsignedInteger('record_id')->nullable();
            $table->foreign('record_id', 'record_fk_2533850')->references('id')->on('records');
        });
    }
}
