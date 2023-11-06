<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('range_pricings', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->integer('min_range')->nullable();
            $table->integer('max_range')->nullable();
            $table->integer('delivery_price')->nullable();
            $table->integer('bag_collection_price')->nullable();
            $table->integer('cash_collection_price')->nullable();
            $table->integer('same_loc_delivery_price')->nullable();
            $table->integer('same_loc_bag_collection_price')->nullable();
            $table->integer('same_loc_cash_collection_price')->nullable();
            $table->boolean('active_status')->default(1);
            $table->boolean('is_same_for_all_services')->default(1);
            $table->string('currency')->nullable();
            $table->uuid('city_id');
            $table->uuid('business_id')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pricings');
    }
};
