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
        Schema::create('empty_bag_collections', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('customer_id')->nullable();
            $table->uuid('bag_id')->nullable();
            $table->uuid('delivery_id')->nullable();
            $table->uuid('empty_bag_collection_batch_id')->nullable();
            $table->uuid('empty_bag_collection_delivery_id')->nullable();


            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("set null");
            $table->foreign("bag_id")->references("id")->on("bags")->onDelete("set null");
            $table->foreign("empty_bag_collection_batch_id")->references("id")->on("empty_bag_collection_batches")->onDelete("set null");
            $table->foreign("delivery_id")->references("id")->on("deliveries")->onDelete("set null");
            $table->foreign("empty_bag_collection_delivery_id")->references("id")->on("deliveries")->onDelete("set null");


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
        Schema::dropIfExists('empty_bag_collections');
    }
};
