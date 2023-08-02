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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('address');
            $table->string('area_name');
            $table->string('city_name');
            $table->string('state_name');
            $table->string('country_name');
            $table->string('address_type');
            $table->string('google_coordinates');
            $table->uuid('customer_id');
            $table->uuid('area_id');
            $table->uuid('city_id');
            $table->uuid('state_id');
            $table->uuid('country_id');
            $table->uuid('branch_id');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('is_deleted');
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
        Schema::dropIfExists('customer_addresses');
    }
};
