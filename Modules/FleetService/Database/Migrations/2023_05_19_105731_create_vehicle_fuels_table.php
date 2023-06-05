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

                $table->uuid('id');
                $table->uuid('vehicle_id')->nullable();
                $table->uuid('driver_id')->nullable();
                $table->enum('fuel_type', ['Diesel', 'Petrol', 'Gas', 'Electric']);
                $table->decimal('fuel_quantity', 10, 2);
                $table->date('fuel_date');
                $table->decimal('Fuel_cost', 10, 2)->nullable();
                $table->string('supplier', 100)->nullable();
                $table->string('notes', 255)->nullable();
                $table->timestamps();
    
                // Define foreign key constraints
                $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete("set null");
                $table->foreign('driver_id')->references('id')->on('drivers')->onDelete("set null");


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
