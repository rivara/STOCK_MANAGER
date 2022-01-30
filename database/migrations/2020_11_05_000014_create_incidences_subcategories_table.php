<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidencesSubcategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('incidences_subcategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('incidence_subcategory');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
