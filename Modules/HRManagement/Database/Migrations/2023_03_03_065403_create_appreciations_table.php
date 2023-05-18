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
        Schema::create('appreciations', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->date("date");
            $table->text("note")->nullable();
            $table->string("picture")->nullable();
            $table->double("amount")->nullable();

            $table->timestamps();

            $table->uuid("award_id")->nullable();
            $table->uuid("employee_id")->nullable();
            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("set null");

            $table->foreign("award_id")->references("id")->on("awards")->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appreciations');
    }
};
