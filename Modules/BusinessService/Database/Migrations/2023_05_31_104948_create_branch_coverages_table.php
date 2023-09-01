<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_coverages', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->boolean('active_status');
            $table->uuid('area_id');
            $table->uuid('city_id');
            $table->uuid('state_id');
            $table->uuid('country_id');
            $table->uuid('branch_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branch_coverages');
    }
};
