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
        Schema::create('teams', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("team_name");
            $table->text("description")->nullable();
            $table->string("status")->default("active");
            $table->timestamps();

            $table->uuid("department_id")->nullable();
            $table->foreign("department_id")->references("id")->on("departments")->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teams');
    }
};
