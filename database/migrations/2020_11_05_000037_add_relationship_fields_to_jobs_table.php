<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJobsTable extends Migration
{
    public function up()
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->unsignedInteger('type_id');
            $table->foreign('type_id', 'type_fk_2534289')->references('id')->on('task_tags');
            $table->unsignedInteger('mark_id')->nullable();
            $table->foreign('mark_id', 'mark_fk_2534291')->references('id')->on('marks');
            $table->unsignedInteger('sample_id')->nullable();
            $table->foreign('sample_id', 'sample_fk_2534292')->references('id')->on('samples');
        });
    }
}
