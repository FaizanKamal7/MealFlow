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
        Schema::create('delivery_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('delivery_id');
            $table->string('image_url');
            $table->string('image_type');
            $table->string('note')->nullable();
            $table->foreign('delivery_id')->on('deliveries')->references('id')->onDelete('cascade');
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
        Schema::dropIfExists('delivery_images');
    }
};
