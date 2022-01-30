<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serial_number')->nullable();
            $table->string('name')->nullable();
            $table->longText('notes')->nullable();
            $table->string('regulations')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('subcategory_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
