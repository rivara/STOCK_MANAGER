<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRecordtaskTable extends Migration
{
    public function up()
    {
        Schema::table('record_task', function (Blueprint $table) {
            $table->unsignedInteger('record_id');
            $table->foreign('record_id')->references('id')->on('records');
            $table->unsignedInteger('task_id');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }
}
