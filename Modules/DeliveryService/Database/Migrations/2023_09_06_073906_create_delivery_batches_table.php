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
        Schema::create('delivery_batches', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->dateTime("batch_start_time")->nullable();
            $table->dateTime("batch_end_time")->nullable();
            $table->string("batch_arrival_map_coordinates")->nullable();
            $table->string("batch_end_map_coordinates")->nullable();
            $table->string("status")->nullable();
            $table->uuid("driver_id")->nullable();
            $table->uuid("vehicle_id")->nullable();
            $table->foreign("vehicle_id")->references("id")->on("vehicles")->onDelete("set null");
            $table->foreign("driver_id")->references("id")->on("drivers")->onDelete("set null");
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
        Schema::dropIfExists('delivery_batches');
    }
};
