<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidencesCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('incidences_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('incidence_category')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
