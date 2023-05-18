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
        Schema::create('timesheets', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("sheet_title")->nullable();
            $table->date("date")->nullable();
            $table->text("description")->nullable();
            $table->double("hours_worked")->nullable();
            $table->string("status")->nullable();
            $table->timestamps();

            $table->uuid("employee_id")->nullable();
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheets');
    }
};
