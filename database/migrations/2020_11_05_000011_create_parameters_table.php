<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametersTable extends Migration
{
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->integer('period');
            $table->integer('decimals')->nullable();
            $table->string('formula')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->boolean('alarm')->default(0);
            $table->float('max_value', 10, 4)->nullable();
            $table->date('min_value')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
