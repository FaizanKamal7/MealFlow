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
        Schema::create('delivery_timelines', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("delivery_id")->nullable();
            $table->uuid("status_id")->nullable();
            $table->uuid("action_by")->nullable();
            $table->uuid("vehicle_id")->nullable();
            $table->text("description")->nullable();
            $table->foreign("delivery_id")->references("id")->on("deliveries")->onDelete("cascade");
            $table->foreign("status_id")->references("id")->on("delivery_statuses")->onDelete("set null");
            $table->foreign("action_by")->references("id")->on("users")->onDelete("set null");
            $table->foreign("vehicle_id")->references("id")->on("vehicles")->onDelete("set null");
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
        Schema::dropIfExists('delivery_timelines');
    }
};
