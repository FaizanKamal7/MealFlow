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
        Schema::create('employee_media', function (Blueprint $table) {
            $table->uuid("id")->primary();

            $table->string("path");
            $table->string("type")->nullable();

            $table->uuid("employee_id");
            $table->timestamps();

            $table->foreign("employee_id")->references("id")->on("employees")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_media');
    }
};
