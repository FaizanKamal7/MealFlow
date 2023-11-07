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
        Schema::create('meal_plan_logs', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("action");
            $table->uuid("action_by")->nullable();;
            $table->uuid('meal_plan_id')->nullable();
            $table->foreign("action_by")->references("id")->on("users")->onDelete("set null");
            $table->foreign("meal_plan_id")->references("id")->on("meal_plans")->onDelete("set null");
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
        Schema::dropIfExists('meal_plan_logs');
    }
};
