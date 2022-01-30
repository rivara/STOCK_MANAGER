<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculationsTable extends Migration
{
    public function up()
    {
        Schema::create('calculations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('calculation')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
