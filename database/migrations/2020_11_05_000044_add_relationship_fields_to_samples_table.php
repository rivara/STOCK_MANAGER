<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSamplesTable extends Migration
{
    public function up()
    {
        Schema::table('samples', function (Blueprint $table) {
            $table->unsignedInteger('mark_id');
            $table->foreign('mark_id', 'mark_fk_2527894')->references('id')->on('marks');
        });
    }
}
