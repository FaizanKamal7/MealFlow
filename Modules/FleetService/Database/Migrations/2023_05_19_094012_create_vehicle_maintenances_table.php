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
        Schema::create('vehicle_maintenances', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid('vehicle_id')->nullable();
            $table->uuid('employee_id')->nullable();
            $table->date('maintenance_date');
            $table->string('maintenance_type', 50);
            $table->text('description');
            $table->decimal('cost', 10, 2);
            $table->text('notes')->nullable(); //vendor
            $table->text('Garage')->nullable(); //additional notes 
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete("set null");
            // $table->foreign('employee_id')->references('id')->on('employees')->onDelete("set null");

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_maintenances');
    }
};
