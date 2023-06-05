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
        Schema::create('vehicle_logs', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid('vehicle_id');
            $table->uuid('driver_id')->nullable();
            $table->dateTime('check_in_time')->nullable();
            $table->dateTime('check_out_time')->nullable();
            $table->string('device_details')->nullable();
            $table->uuid('checked_out_user')->nullable();

            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreign('checked_out_user')->references('id')->on('users');

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
        Schema::dropIfExists('vehicle_logs');
    }
};
