<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_pricings', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->integer('min_range');
            $table->integer('max_range');
            $table->integer('range_price');
            $table->integer('same_loc_range_price');
            $table->integer('delivery_slot_price');
            $table->integer('same_loc_delivery_slot_price');
            $table->boolean('is_base_price');
            $table->boolean('active_status');
            $table->string('currency');
            $table->string('pricing_type');
            $table->uuid('city_id');
            $table->uuid('business_id');
            $table->uuid('delivery_slot_id');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
            $table->foreign('delivery_slot_id')->references('id')->on('delivery_slots')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('business_pricings');
    }
};
