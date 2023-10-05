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
        Schema::create('bag_timelines', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("status")->nullable();
            $table->uuid("bag_id");
            $table->uuid("delivery_id")->nullable();
            $table->uuid("action_by")->nullable();
            $table->uuid("vehicle_id")->nullable();
            $table->text("description")->nullable();
            $table->foreign("bag_id")->references("id")->on("bags")->onDelete("cascade");
            $table->foreign("action_by")->references("id")->on("users")->onDelete("set null");
            $table->foreign("vehicle_id")->references("id")->on("vehicles")->onDelete("set null");
            $table->foreign("delivery_id")->references("id")->on("deliveries")->onDelete("set null");
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
        Schema::dropIfExists('bag_timelines');
    }
};
