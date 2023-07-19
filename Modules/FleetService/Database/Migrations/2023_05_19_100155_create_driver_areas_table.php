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
        Schema::create('driver_areas', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("driver_id");
            $table->uuid("area_id")->nullable();

            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete("cascade");
            $table->foreign('area_id')->references('id')->on('areas')->onDelete("set null");

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
        Schema::dropIfExists('driver_areas');
    }
};
