<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_models', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string("model_name");
            $table->uuid("app_id");
            $table->timestamps();

            $table->foreign("app_id")->references("id")->on("applications")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application_models');
    }
};
