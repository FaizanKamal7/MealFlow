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
        Schema::create('delivery_bags', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("delivery_id")->nullable();
            $table->uuid("bag_id")->nullable();
            $table->foreign("delivery_id")->references("id")->on("deliveries")->onDelete("set null");
            $table->foreign("bag_id")->references("id")->on("bags")->onDelete("set null");
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
        Schema::dropIfExists('delivery_bags');
    }
};
