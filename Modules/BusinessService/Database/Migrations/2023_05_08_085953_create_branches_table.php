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
        Schema::create('branches', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('active_status');
            $table->boolean('is_main_branch');
            $table->string('map_selected_area')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();  // 10 digits total, 7 after the decimal point
            $table->decimal('longitude', 10, 7)->nullable(); // 10 digits total, 7 after the decimal point
            $table->uuid('city_id')->nullable();
            $table->uuid('state_id')->nullable();
            $table->uuid('area_id')->nullable();
            $table->uuid('country_id')->nullable();
            $table->uuid('business_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('set null');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('branches');
    }
};
