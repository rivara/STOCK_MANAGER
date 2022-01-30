<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNetworksTable extends Migration
{
    public function up()
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('network')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
