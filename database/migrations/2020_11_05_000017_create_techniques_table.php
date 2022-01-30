<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechniquesTable extends Migration
{
    public function up()
    {
        Schema::create('techniques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idtechnique')->unique();
            $table->string('technique');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
