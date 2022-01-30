<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncidencesSubcategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('incidences_subcategories', function (Blueprint $table) {
            $table->unsignedInteger('incidence_category_id');
            $table->foreign('incidence_category_id', 'incidence_category_fk_2527921')->references('id')->on('incidences_categories');
        });
    }
}
