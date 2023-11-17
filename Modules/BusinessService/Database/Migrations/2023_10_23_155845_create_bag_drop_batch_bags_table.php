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
<<<<<<<< HEAD:Modules/BusinessService/Database/Migrations/2023_10_23_155845_create_bag_drop_batch_bags_table.php
        Schema::create('bag_drop_batch_bags', function (Blueprint $table) {
========
        Schema::create('meal_plan_logs', function (Blueprint $table) {
>>>>>>>> 34a472928dd6927f2584e4cd9fd16be6ebed9d7b:Modules/BusinessService/Database/Migrations/2023_10_23_155758_create_meal_plan_logs_table.php
            $table->id();

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
<<<<<<<< HEAD:Modules/BusinessService/Database/Migrations/2023_10_23_155845_create_bag_drop_batch_bags_table.php
        Schema::dropIfExists('bag_drop_batch_bags');
========
        Schema::dropIfExists('meal_plan_logs');
>>>>>>>> 34a472928dd6927f2584e4cd9fd16be6ebed9d7b:Modules/BusinessService/Database/Migrations/2023_10_23_155758_create_meal_plan_logs_table.php
    }
};
