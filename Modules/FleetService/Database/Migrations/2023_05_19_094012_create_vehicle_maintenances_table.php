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
            $table->integer('meter_reading')->nullable();
            $table->string('maintenance_category_id')->nullable();
            $table->string('quantity', 20);
            $table->text('maintenance_detail');
            $table->decimal('cost', 10, 2);
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->dateTime('paid_date')->nullable();

            $table->text('notes')->nullable();  //additional notes
            $table->string('garage')->nullable(); // garage name
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete("set null");
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete("set null");
            $table->foreign('maintenance_category_id')->references('id')->on('maintenance_categories')->onDelete("set null");


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
