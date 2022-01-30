<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetLocationsTable extends Migration
{
    public function up()
    {
        Schema::create('asset_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('code')->nullable()->unique();
            $table->string('name_cee')->nullable();
            $table->string('address')->nullable();
            $table->float('longitude', 10, 6)->nullable();
            $table->float('latitude', 10, 6)->nullable();
            $table->float('altitude')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->string('description')->nullable();
            $table->boolean('local_hour')->default(0)->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->unsignedInteger('zone_id')->nullable();
            $table->foreign('zone_id')->references('id')->on('zones');
            $table->unsignedInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->unsignedInteger('province_id')->nullable();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->unsignedInteger('municipality_id')->nullable();
            $table->foreign('municipality_id')->references('id')->on('municipalities');
            $table->unsignedInteger('network_id')->nullable();
            $table->foreign('network_id')->references('id')->on('networks');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
