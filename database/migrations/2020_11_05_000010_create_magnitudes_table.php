<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagnitudesTable extends Migration
{
    public function up()
    {
        Schema::create('magnitudes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idmagnitude')->unique();
            $table->string('magnitude');
            $table->string('description')->nullable();
            $table->integer('high')->nullable();
            $table->integer('low')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
