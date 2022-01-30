<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipalitiesTable extends Migration
{
    public function up()
    {
        Schema::create('municipalities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('municipality');
            $table->unsignedInteger('province_id');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
