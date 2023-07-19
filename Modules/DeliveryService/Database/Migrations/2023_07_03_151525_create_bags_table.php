<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bags', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("qr_code")->nullable();
            $table->string("bag_number")->nullable();
            $table->string("bag_size")->nullable();
            $table->string("bag_type")->nullable();
            $table->string("status")->nullable();
            $table->string("weight")->nullable();
            $table->string("dimensions")->nullable();
            $table->timestamps();
            $table->uuid("business_id");

            $table->foreign("business_id")->references("id")->on("businesses")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bags');
    }
};
