<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAssetSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('asset_sub_categories', function (Blueprint $table) {
            $table->unsignedInteger('asset_category_id');
            $table->foreign('asset_category_id', 'asset_category_fk_2527956')->references('id')->on('asset_categories');
        });
    }
}
