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
        Schema::create('events', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("event_title");
            $table->text("description")->nullable();
            $table->string("venue")->nullable();
            $table->string("color")->nullable();
            $table->dateTime("start_date_time");
            $table->dateTime("end_date_time");
            $table->string("type");

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
        Schema::dropIfExists('events');
    }
};
