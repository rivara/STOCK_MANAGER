<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_2527795')->references('id')->on('task_statuses');
            $table->unsignedInteger('assigned_to_id')->nullable();
            $table->foreign('assigned_to_id', 'assigned_to_fk_2527799')->references('id')->on('users');
            $table->unsignedInteger('asset_id')->nullable();
            $table->foreign('asset_id', 'asset_fk_2527923')->references('id')->on('assets');
            $table->unsignedInteger('location_id')->nullable();
            $table->foreign('location_id', 'location_fk_2527924')->references('id')->on('asset_locations');
            $table->unsignedInteger('period_id')->nullable();
            $table->foreign('period_id', 'period_fk_2527925')->references('id')->on('periods');
            $table->unsignedInteger('incidence_category_id')->nullable();
            $table->foreign('incidence_category_id', 'incidence_category_fk_2527926')->references('id')->on('incidences_categories');
            $table->unsignedInteger('incidence_subcategory_id')->nullable();
            $table->foreign('incidence_subcategory_id', 'incidence_subcategory_fk_2527927')->references('id')->on('incidences_subcategories');
            $table->unsignedInteger('asset_status_id')->nullable();
            $table->foreign('asset_status_id', 'asset_status_fk_2527928')->references('id')->on('asset_statuses');
            $table->unsignedInteger('record_id')->nullable();
            $table->foreign('record_id', 'record_fk_2533842')->references('id')->on('records');
            $table->unsignedInteger('job_id')->nullable();
            $table->foreign('job_id', 'job_fk_2534350')->references('id')->on('jobs');
        });
    }
}
