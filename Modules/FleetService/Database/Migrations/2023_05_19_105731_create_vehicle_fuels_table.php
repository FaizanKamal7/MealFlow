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

                $table->uuid('id')->primary();
                $table->uuid('vehicle_id')->nullable();
                $table->uuid('employee_id')->nullable();
                $table->enum('fuel_type', ['diesel', 'petrol', 'gas', 'electric'])->default("petrol");
                $table->decimal('fuel_quantity', 10, 2);
                $table->date('fuel_date');
                $table->decimal('fuel_cost', 10, 2)->nullable();
                $table->string('supplier', 100)->nullable();
                $table->string('notes', 255)->nullable();
                $table->enum('payment_method', ['topup','cash','credit'])->default('topup');
                $table->dateTime('paid_date')->nullable();


                $table->timestamps();
                $table->softDeletes();

                // Define foreign key constraints
                $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete("set null");
                $table->foreign('employee_id')->references('id')->on('employees')->onDelete("set null");


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
