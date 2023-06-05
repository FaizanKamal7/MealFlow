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
        Schema::create('vehicle_leases', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid('vehicle_id')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_frequency');
            $table->decimal('payment_amount', 10, 2);
            $table->string('status')->default('active');

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
        Schema::dropIfExists('vehicle_leases');
    }
};
