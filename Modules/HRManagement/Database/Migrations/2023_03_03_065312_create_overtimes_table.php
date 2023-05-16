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
        Schema::create('overtimes', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string("title")->nullable();
            $table->text("description")->nullable();
            $table->double("pay_adjustment")->nullable();
            $table->double("hours")->nullable();
            $table->date("date");
            $table->string("status")->nullable();
            $table->timestamps();

            $table->uuid("timesheet_id")->nullable();
            $table->foreign("timesheet_id")->references("id")->on("timesheets")->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('overtimes');
    }
};
