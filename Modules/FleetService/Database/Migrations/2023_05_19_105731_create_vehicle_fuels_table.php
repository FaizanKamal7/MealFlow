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
        Schema::create('vehicle_fuels', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid('vehicle_id');
            $table->date('fuel_date')->nullable();
            $table->decimal('fuel_amount', 10, 2)->nullable();
            $table->decimal('fuel_cost', 10, 2)->nullable();

            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete("set null");
           
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
        Schema::dropIfExists('vehicle_fuels');
    }
};
