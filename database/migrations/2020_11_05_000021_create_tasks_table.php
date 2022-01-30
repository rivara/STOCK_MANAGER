<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('description')->nullable();
            $table->date('due_date')->nullable();
            $table->string('link')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('lost_data')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
