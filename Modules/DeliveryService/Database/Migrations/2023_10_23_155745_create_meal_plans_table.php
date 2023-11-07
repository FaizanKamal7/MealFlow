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
        Schema::create('meal_plans', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->date("start_date");
            $table->date("end_date");
            $table->string("status");
            $table->json("skip_days");
            $table->uuid('business_id')->nullable();
            $table->uuid('customer_id')->nullable();
            $table->foreign("business_id")->references("id")->on("businesses")->onDelete("set null");
            $table->foreign("customer_id")->references("id")->on("customers")->onDelete("set null");
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
        Schema::dropIfExists('meal_plans');
    }
};
