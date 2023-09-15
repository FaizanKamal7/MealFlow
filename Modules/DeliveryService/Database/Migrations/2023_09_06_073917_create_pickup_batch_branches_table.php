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
        Schema::create('pickup_batch_branches', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->dateTime("arrival_time");
            $table->dateTime("start_time");
            $table->dateTime("end_time");
            $table->string("arrival_map_coordinates");
            $table->string("start_map_coordinates");
            $table->string("end_map_coordinates");
            $table->uuid("branch_id")->nullable();
            $table->uuid("pick_up_batch_id")->nullable();
            $table->foreign("branch_id")->references("id")->on("branches")->onDelete("set null");
            $table->foreign("pick_up_batch_id")->references("id")->on("pickup_batches")->onDelete("set null");
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
        Schema::dropIfExists('pickup_batch_branches');
    }
};
