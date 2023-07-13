<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bag_logs', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->uuid("bag_id");
            $table->string("previous_status")->nullable();
            $table->string("current_status");
            $table->text("description")->nullable();

            $table->foreign("bag_id")->references("id")->on("bags")->onDelete("cascade");
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
        Schema::dropIfExists('bag_logs');
    }
};
